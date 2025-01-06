<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kKematian;
use App\Models\User;
use App\Models\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class kKematianController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profiles = Profile::all();
        $kKematians = kKematian::all();

        $uid = Auth::user()->userID;
        $role = Auth::user()->role;

        $user = $users->where("userID", $uid)->first();
        $profile = $profiles->where("userID", $uid)->first();
        if ($role == 'Citizen') {
            return view('manage_khairat_kematian.kKematianApplication', compact('user', 'profile'));

        } elseif ($role == 'Admin') {
            return view('manage_khairat_kematian.kKematianList', compact('users', 'profiles', 'kKematians', 'role'));
        }
    }



    public function store(Request $request)
    {
        $uid = $request['uid'];

        // Fetch user and profile
        $user = User::where("userID", $uid)->first();
        $profile = Profile::where("userID", $uid)->first();

        // Generate unique ID and status for kKematian
        $kkID = 'KK' . rand(1111, 9999);
        $status = "PENDING";


        $application = $request->file('icPic');
        // dd($receipt);
        $rand = rand(10000, 99999);
        $applicationID = "APPLICATION_" . $rand;
        $applicationName = $application->extension();
        $applications = $applicationID . '.' . $applicationName;

        $path = 'application/' . $applicationID . '.' . $applicationName;

        Storage::disk('public')->put($path, file_get_contents($application));


        // Create kKematian record
        $kKematian = kKematian::create([
            'kkID' => $kkID,
            'userID' => $uid,
            'pictureIC' => $applications, // Assuming 'pictureIC'
            'status' => $status,
        ]);

        // Update profile's phone number
        Profile::where('userID', $uid)->update([
            'phone' => $request['phone'],
            'heir' => $request['nama_waris'],
        ]);

        // Redirect to payment route with necessary data
        return redirect()->route('payment', compact('user', 'profile', 'kKematian'));
    }

    public function reject(Request $request)
    {
        $kkID = $request['id'];
        $status = 'REJECTED';
        kKematian::where('kkID', $kkID)->update([
            'status' => $status,
        ]);

        return redirect()->route('kKematian', )->with('Reject', $kkID . ' Has Been Rejected');
    }
}
