<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kKematian;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class JenazahController extends Controller
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
        $kKematian = $kKematians->where("userID", $uid)->first();

        if ($role == 'Citizen') {
            return view('manage_jenazah.jenazahAdd', compact('user', 'profile', 'profiles', 'kKematian'));

        }
        //  elseif ($role == 'Admin') {
        //     return view('manage_khairat_kematian.kKematianList', compact('users', 'profiles', 'kKematians', 'role'));
        // }
    }

    public function store(Request $request)
    {
        $uid = $request['uid'];

        // Generate unique ID and status for kKematian
        $jenID = 'JEN' . rand(1111, 9999);
        $status = "INCOMPLETE DETAIL";


        $permit = $request->file('permit');
        // dd($receipt);
        $rand = rand(10000, 99999);
        $permitID = "APPLICATION_" . $rand;
        $permitName = $permit->extension();
        $permits = $permitID . '.' . $permitName;

        $path = 'application/' . $permitID . '.' . $permitName;

        Storage::disk('public')->put($path, file_get_contents($permit));


        // Create kKematian record
        $kKematian = kKematian::create([
        'jenazahID' => $jenID,
        'userID' => $uid,
        'jenazahIC' => $request['jenIC'],
        'jenazahName' => $request['jenName'],
        'jenazahGender' => $request['jenGender'],
        'jenazahDOB' => $request['jenDOB'],
        'jenazahBangsa' => $request['jenBangsa'],
        'jenazahWarga' => $request['jenWarga'],
        'deathDate' => $request['deathDate'],
        'permit' => $permits,
        'status' => $status,
        ]);

        // Redirect to payment route with necessary data
        return redirect()->route('payment', compact('user', 'profile', 'kKematian'));
    }

}
