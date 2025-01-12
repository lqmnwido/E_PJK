<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Payment;
use App\Models\kKematian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profiles = Profile::all();
        $kKematians = kKematian::all();
        $payments = Payment::all();
        $uid = Auth::user()->userID;
        $role = Auth::user()->role;

        $user = $users->where("userID", $uid)->first();
        $profile = $profiles->where("userID", $uid)->first();
        $kKematian = $kKematians->where("userID", $uid)->first();
        if ($role == 'Citizen') {
            return view('manage_payment.paymentAdd', compact('user', 'profile', 'kKematian'));

        }elseif ($role == 'Admin') {
            return view('manage_payment.paymentList', compact('users', 'kKematians', 'payments', 'role'));
        }
    }

    public function history()
    {
        $users = User::all();
        $paymentss = Payment::all();
        $uid = Auth::user()->userID;
        $role = Auth::user()->role;

        $user = $users->where("userID", $uid)->first();
        $payments = $paymentss->where("userID", $uid);
        if ($role == 'Citizen') {
            return view('manage_payment.paymentList', compact('user', 'payments', 'role'));

        }
    }

    public function store(Request $request)
    {
        $userID = $request['uid'];
        $pay = Payment::where('userID', $userID)->first();
        if($pay && $pay->status=='PENDING'){
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

            $billName = $request['service'];
            $description = $paymentID;
            $amount = $request['totalPayment'];
            $refNo = $paymentID;
            $name = $request['name'];
            $email = $request['email'];
            $phone = $request['phone'];

            $receipts = null;
            Payment::create([
                'paymentID' => $paymentID,
                'userID' => $request['uid'],
                'services' => $request['service'],
                'amount' => $request['totalPayment'],
                'typeOfPayment' => $request['paymentOpt'],
                'status' => 'PENDING',
                'receipt' => $receipts,
            ]);
            return redirect()->route('toyyibpay-create', compact('billName', 'description', 'amount', 'refNo', 'name', 'email', 'phone', 'expires'));


        }

        Payment::create([
            'paymentID' => $paymentID,
            'userID' => $request['uid'],
            'services' => $request['service'],
            'amount' => $request['totalPayment'],
            'typeOfPayment' => $request['paymentOpt'],
            'status' => 'PENDING',
            'receipt' => $receipts,
        ]);



        return redirect()->route('dashboard')->with('success', 'Payment Successful!');
    }


    //PAYMENT GATEWAY
    public function createBill($billName, $description, $amount, $refNo, $name, $email, $phone, $expires)
    {

        $expire = date("Y-m-d", $expires);

        $receipts = array(
            'userSecretKey' => 'hu7sij8w-6y30-ymrs-chmw-eakjreybb8q4',
            'categoryCode' => 'mm8jwntq',
            'billName' => $billName,
            'billDescription' => $description,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $amount * 100,
            'billReturnUrl' => route('toyyibpay-status'),
            'billCallbackUrl' => route('toyyibpay-callback'),
            'billExternalReferenceNo' => $refNo,
            'billTo' => $name,
            'billEmail' => $email,
            'billPhone' => $phone,
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => 0,
            'billContentEmail' => 'Thank you for paying your fee!',
            'billChargeToCustomer' => 1,
            'billExpiryDate' => $expire,
            'billExpiryDays' => 2
        );

       
        echo ' </br>';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://dev.toyyibpay.com/index.php/api/createBill');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $receipts);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);
        $obj = json_decode($result);
  echo $result;

        // Decode the JSON response
        $response = json_decode($result, true); // Set the second parameter to true to get an associative array

        // Check if decoding was successful and 'BillCode' is present
        if (is_array($response) && isset($response[0]['BillCode'])) {
            $billCode = $response[0]['BillCode'];
            return redirect('https://dev.toyyibpay.com/'. $billCode);
        } else {
            //echo 'Failed to retrieve BillCode from the response.';
        }

    }

    public function paymentStatus()
    {
        
        

        $response = request()->all(['status_id', 'billcode', 'order_id', 'billName']);
        
        $status = $response['status_id'];
        $id = $response['order_id'];
        $payment = Payment::where('paymentID', $id)->first();
        $uid = $payment->userID;

        if ($status == '1') {
            Payment::where('paymentID', $id)->update([
                'status' => 'SUCCESSFUL',
            ]);
            if (kKematian::where('userID', $uid)->first()){
                if (kKematian::where('status', "PENDING")->first()){
                    kKematian::where('userID', $uid)->update([
                        'status' => 'SUCCESSFUL',
                    ]);
                }
            }
            return redirect()->route('dashboard')->with('success', 'Payment Successful!');
        }elseif ($status == '3') {
            Payment::where('paymentID', $id)->update([
                'status' => 'UNSUCCESSFUL',
            ]);
            if (kKematian::where('userID', $uid)->first()){
                if (kKematian::where('status', "PENDING")->first()){
                    kKematian::where('userID', $uid)->update([
                        'status' => 'UNSUCCESSFUL',
                    ]);
                }
            }
            return redirect()->route('dashboard')->with('alert', 'Payment Unsuccessful!');
        }else{
            Payment::where('paymentID', $id)->update([
                'status' => 'PENDING',
            ]);
        }
        return redirect()->route('dashboard')->with('alert', 'Payment Pending!');
    }



    public function callBack()
    {
        $response = request()->all(['refno', 'status','reason','billcode', 'order_id', 'amount']);
        Log::info($response);
    }

    public function approve(Request $request)
    {
        $Payment_ID = $request['id'];
        $status = 'APPROVED';
        Payment::where('paymentID', $Payment_ID )->update([
            'status' => $status,
        ]);

        return redirect()->route('payment')->with('Approve', $Payment_ID.' Has Been Approved');
    }

    public function reject(Request $request)
    {
        $Payment_ID = $request['id'];
        $status = 'REJECTED';
        Payment::where('paymentID', $Payment_ID )->update([
            'status' => $status,
        ]);

        return redirect()->route('payment', )->with('Reject', $Payment_ID.' Has Been Rejected');
    }

}
