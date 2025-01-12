<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenazahController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
}) -> name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index') -> name('dashboard');
});

//user
Route::get('/user', 'App\Http\Controllers\ProfileController@index') -> name('user_list');

Route::resource('users',App\Http\Controllers\ProfileController::class);

Route::get('/users/{user}/edit', [ProfileController::class, 'edit'])->name('update_user');

//khairat kematian
Route::resource('kKematian',App\Http\Controllers\kKematianController::class);
Route::get('/KhairatKematian', 'App\Http\Controllers\kKematianController@index') -> name('kKematian');
Route::get('/KhairatKematian/reject', 'App\Http\Controllers\kKematianController@reject') -> name('kKematian_reject');

//payment
Route::resource('payments',App\Http\Controllers\PaymentController::class);

Route::get('/payment', 'App\Http\Controllers\PaymentController@index') -> name('payment');
Route::post('/payments/store', 'App\Http\Controllers\PaymentController@store') -> name('store_payment');
Route::get('/payment/history', 'App\Http\Controllers\PaymentController@history') -> name('history');
Route::post('/payment/approve', 'App\Http\Controllers\PaymentController@approve') -> name('approve');
Route::post('/payment/reject', 'App\Http\Controllers\PaymentController@reject') -> name('reject');

//Payment Gateway
Route::get('toyyibpay/{billName}/{description}/{amount}/{refNo}/{name}/{email}/{phone}/{expires}','App\Http\Controllers\PaymentController@createBill') -> name('toyyibpay-create');
Route::get('toyyibpay-status','App\Http\Controllers\PaymentController@paymentStatus') -> name('toyyibpay-status');
Route::post('toyyibpay-callback','App\Http\Controllers\PaymentController@callBack') -> name('toyyibpay-callback');

//Jenazah 
Route::resource('jenazahs',App\Http\Controllers\JenazahController::class);
Route::get('/jenazah', 'App\Http\Controllers\JenazahController@index') -> name(name: 'jenazah');
Route::post('/jenazah/store', 'App\Http\Controllers\JenazahController@store') -> name('store_jenazah');
Route::post('/assign-jenazah', [JenazahController::class, 'updateAssign'])->name('assign.jenazah');


//Profile
Route::post('/user/save', 'App\Http\Controllers\ProfileController@save')-> name('profile_update');

//Location 
Route::post('/location','App\Http\Controllers\LocationController@index') -> name('location');
Route::post('/location/submit',[LocationController::class, 'store']) -> name('location-submit');
Route::post('/search',[LocationController::class, 'search']) -> name('location-search');