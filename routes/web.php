<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/', 'App\Http\Controllers\HomeController@index') -> name('dashboard');
});

//user
Route::get('/dashboard', 'App\Http\Controllers\ProfileController@index') -> name('user_list');

Route::resource('users',App\Http\Controllers\ProfileController::class);

Route::get('/users/{user}/edit', [ProfileController::class, 'edit'])->name('update_user');

//khairat kematian
Route::resource('kKematian',App\Http\Controllers\kKematianController::class);

Route::get('/KhairatKematian', 'App\Http\Controllers\kKematianController@index') -> name('kKematian');

//payment
Route::get('/payment', 'App\Http\Controllers\paymentController@index') -> name('payment');