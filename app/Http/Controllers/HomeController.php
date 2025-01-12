<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\kKematian;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $kKematians = kKematian::all();

        $role=Auth::user()->role;
        $uid=Auth::user()->userID;

        $users = User::all();
        $kKematian = $kKematians->where("userID", $uid)->first();
        if($role=='Admin')
        {
            return redirect()->route('user_list');
        }
        elseif($role=='Citizen')
        {
            return view('dashboard', compact('uid', 'role', 'kKematian'));
        }else{
            return redirect()->route('jenazah');
        }
           
    }
}
