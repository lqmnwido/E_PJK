<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenazah;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
class LocationController extends Controller
{
    public function index(Request $request) // Add the $request parameter here
    {
        $jenID = $request['jenID']; // Now $request will work correctly

        $jenazahs = Jenazah::all();

        // Assuming 'jenazahID' is the column you are trying to filter by
        $jenazah = $jenazahs->where("jenazahID", $jenID)->first();

        return view('manage_location.addLocation', compact('jenazah')); // Pass correct data to the view
    }

    public function store(Request $request)
    {
        $jenID = $request['jenID'];

        $location = Location::create([
            'locationID' => $request['lotID'],
            'latitude' => $request['lat'],
            'longitude' => $request['lng'],
            'cemetery' => $request['searchmap'],
        ]);


        // Update Jenazah
        Jenazah::where('jenazahID', $jenID)->update([
            'locationID' => $request['lotID'],
            'graveLot' => $request['lotID'],
            'status' => 'COMPLETED'
        ]);

        $role=Auth::user()->role;
        return redirect()->route('dashboard');
    }

    public function search(Request $request) // Add the $request parameter here
    {
        $ic = $request['ic']; // Now $request will work correctly

        $jenazahs = Jenazah::all();
        $locations = Location::all();

        // Assuming 'jenazahID' is the column you are trying to filter by
        $jenazah = $jenazahs->where("jenazahIC", $ic)->first();

        return view('welcome', compact('jenazah', 'locations')); // Pass correct data to the view
    }

}
