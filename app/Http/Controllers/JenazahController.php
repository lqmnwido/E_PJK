<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kKematian;
use App\Models\User;
use App\Models\Profile;
use App\Models\Jenazah;
use App\Models\Payment;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class JenazahController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profiles = Profile::all();
        $kKematians = kKematian::all();
        $jenazahs = Jenazah::all();
        $locations = Location::all();

        $uid = Auth::user()->userID;
        $role = Auth::user()->role;

        $user = $users->where("userID", $uid)->first();
        $profile = $profiles->where("userID", $uid)->first();
        $kKematian = $kKematians->where("userID", $uid)->first();

        if ($role == 'Citizen') {
            return view('manage_jenazah.jenazahAdd', compact('user', 'profile', 'profiles', 'kKematian'));

        } elseif ($role == 'Admin') {
            return view('manage_jenazah.jenazahList', compact('jenazahs', 'profiles', 'users', 'role'));
        }elseif ($role == 'Pengurus Jenazah') {
            return view('manage_jenazah.jenazahList', compact('jenazahs', 'profiles', 'users', 'locations','role', 'uid'));
        }
    }

    public function store(Request $request)
    {
        $kKematians = kKematian::all();
        $uid = $request['uid'];
        $kKematian = $kKematians->where("userID", $uid)->first();
        // Generate unique ID and status for kKematian
        $jenID = 'JEN' . rand(1111, 9999);
        $status = "PENDING";

        if ($request->hasFile('permit')) {
            $permit = $request->file('permit');
            // dd($receipt);
            $rand = rand(10000, 99999);
            $permitID = "APPLICATION_" . $rand;
            $permitName = $permit->extension();
            $permits = $permitID . '.' . $permitName;

            $path = 'application/' . $permitID . '.' . $permitName;

            Storage::disk('public')->put($path, file_get_contents($permit));
        } else {
            $permits = null;
        }

        // Create Jenazah record
        $Jenazah = Jenazah::create([
            'jenazahID' => $jenID,
            'userID' => $uid,
            'jenazahIC' => $request['jenIC'],
            'jenazahName' => $request['jenName'],
            'jenazahGender' => $request['jenGender'],
            'jenazahDOB' => $request['jenDOB'],
            'jenazahBangsa' => $request['jenBangsa'],
            'jenazahWarga' => $request['jenWarga'],
            'deathDate' => $request['deathDate'],
            'services' => json_encode($request->services),
            'permit' => $permits,
            'status' => $status,
        ]);

        $totalPrice = $request['totalPrice'];

        $pay = Payment::where('userID', $uid)->first();
        if ($pay && $pay->status == 'PENDING') {
            $pay->delete();
        }

        $month = date('m');
        $date = date("Y-m-d");
        $expires = strtotime('+2 days', strtotime($date));
        $ranID = rand(10000, 99999);
        $paymentID = 'PAY' . $ranID;

        if ($request['paymentOpt'] == 'CDM') {
            $receipt = $request->file('receipt');
            // dd($receipt);
            $rand = rand(10000, 99999);
            $receiptID = "RECEIPT_" . $rand;
            $receiptName = $receipt->extension();
            $receipts = $receiptID . '.' . $receiptName;

            $path = 'receipt/' . $receiptID . '.' . $receiptName;

            Storage::disk('public')->put($path, file_get_contents($receipt));
        } else {

            $billName = 'Bayaran Pengurusan Jenazah';
            $description = $paymentID;
            $amount = $totalPrice;
            $refNo = $paymentID;
            $name = $request['name'];
            $email = $request['email'];
            $phone = $request['phone'];

            $receipts = null;
            Payment::create([
                'paymentID' => $paymentID,
                'userID' => $request['uid'],
                'services' => json_encode($request->services),
                'amount' => $totalPrice,
                'typeOfPayment' => $request['paymentOpt'],
                'status' => 'PENDING',
                'receipt' => $receipts,
            ]);
            return redirect()->route('toyyibpay-create', compact('billName', 'description', 'amount', 'refNo', 'name', 'email', 'phone', 'expires'));


        }

        Payment::create([
            'paymentID' => $paymentID,
            'userID' => $uid,
            'services' => json_encode($request->services),
            'amount' => $totalPrice,
            'typeOfPayment' => $request['paymentOpt'],
            'status' => 'PENDING',
            'receipt' => $receipts,
        ]);



        return redirect()->route('dashboard')->with('success', 'Payment Successful!');
    }

    public function updateAssign(Request $request)
    {
        \Log::info('Jenazah ID:', ['id' => $request->jenazah_id]);
        \Log::info('Pengurus ID:', ['userID' => $request->pengurus_id]);

        try {
            // Validate the incoming request
            $request->validate([
                'jenazah_id' => 'required|exists:jenazah,id',
                'pengurus_id' => 'required|exists:users,userID',
            ]);

            // Find the Jenazah record
            $jenazah = Jenazah::findOrFail($request->jenazah_id);

            // Check if already assigned
            if ($jenazah->assign) {
                return response()->json([
                    'success' => false,
                    'message' => 'This Jenazah is already assigned.',
                ], 400);
            }

            // Find the Pengurus (user)
            $pengurus = User::where('userID', $request->pengurus_id)->firstOrFail();

            // Assign the pengurus name to the Jenazah record
            $jenazah->assign = $pengurus->userID;
            $jenazah->status = 'PROGRESS';
            $jenazah->save();

            return response()->json([
                'success' => true,
                'message' => 'Assign updated successfully.',
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error($e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

}
