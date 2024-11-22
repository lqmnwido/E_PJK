<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        
        $role=Auth::user()->role;
        $uid=Auth::user()->userID;

        $users = User::all();

        if($role=='Admin')
        {
            return redirect()->route('user_list');
        }
        else
        {
            return view('dashboard', compact('uid', 'role'));
        }
    }
}
