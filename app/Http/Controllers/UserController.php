<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $profile = Profile::all()->keyBy('userID'); // Index profiles by userID
        $role = Auth::user()->role;

        if ($role == 'Admin') {
            return view('manage_user.userList', compact('users','profile'));

        }

    }

    public function create()
    {
        $role = Auth::user()->role;

        if ($role == 'Admin') {
            return view('manage_user.userAdd');
        }
    }

    public function store(Request $request)
    {
        $userID = 'U' . rand(1111, 9999);
        // Create User
        $user = User::create([
            'userID' => $userID,
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
        ]);

        $profileID = 'P' . rand(1111, 9999);

        // Create Profile
        Profile::create([
            'profileID' => $profileID,
            'userID' => $userID,
            'noIC' => $request['noIC'],
            'DOB' => $request['DOB'],
            'nationality' => $request['nationality'],
            'race' => $request['race'],
            'gender' => $request['gender'],
            'address' => $request['address'],
        ]);

        return redirect()->route('user_list')->with('success', 'User Added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $userID)
    {
        $profile = Profile::where('userID', $userID)->first();
        $user = User::where('userID', $userID)->first();
        // dd($user);
        return view('manage_user.userEdit', ['user' => $user, 'profile' => $profile]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $users)
    {
        // Create User
        User::where('userID', $users)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'role' => $request['role'],
        ]);

        // Create Profile
        Profile::where('userID', $users)->update([
            'DOB' => $request['DOB'],
            'nationality' => $request['nationality'],
            'race' => $request['race'],
            'gender' => $request['gender'],
            'address' => $request['address'],
        ]);

        return redirect()->route('users.index')->with('success', 'User Updated!');
    }

    public function destroy(string $userID)
    {
        $profile = Profile::where('userID', $userID)->first();
        $user = User::where('userID', $userID)->first();
        $user->delete();
        $profile->delete();

        return redirect()->route('users.index')->with('success', 'User Deleted!');
    }
}
