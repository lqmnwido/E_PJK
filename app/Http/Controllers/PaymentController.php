<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    public function index()
    {
        $users = User::all();
        $profiles = Profile::all();

        $uid = Auth::user()->userID;
        $role = Auth::user()->role;

        $user = $users->where("userID", $uid)->first();
        $profile = $profiles->where("userID", $uid)->first();
        if ($role == 'Citizen') {
            return view('manage_payment.paymentAdd', compact('user', 'profile'));

        // }elseif ($role == 'FK Bursary') {
        //     return view('manage_payment.paymentList', compact('users', 'applications', 'payments', 'type'));
        }
    }
}
