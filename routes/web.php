<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewEnglandController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Http;

Route::get('/welcome', function () {
    return view('welcome');
});


Route::group(['middleware'=>'auth'],function()  {

// admin dashboard----------------------------------------------------------------------------------------------------->>>
Route::get('/admin', [NewEnglandController::class, 'adminDashboard'])->name('dashboard');

// NewEngland route---------------------------------------------------------------------------------------------------->>>

// it store the state geojson data
Route::get('/NewEngland/state-form',[NewEnglandController::class ,'create'])->name('NewEnglandstate.create');

// it store the state form data into database 
Route::post('/NewEngland/state-store', [NewEnglandController::class, 'newEnglandFormStore'])->name('NewEnglandstate.store');
// it is use to get places form 
Route::get('/NewEngland/places', [NewEnglandController::class, 'manageNewEnglandPlace'])->name('NewEnglandplaces.create');
// it store the place form data to database
Route::post('/NewEngland/places-store', [NewEnglandController::class, 'storeNewEnglandPlace'])->name('NewEnglandplace.store');
// this route will call delete function which will delete the places from database
Route::delete('/NewEngland/places/{id}', [NewEnglandController::class, 'newEnglandDelete'])->name('NewEnglandplace.delete');

Route::get('/NewEngland/edit-place/{id}', [NewEnglandController::class, 'manageNewEnglandPlace'])->name('NewEnglandplace.edit');
Route::put('NewEngland/edit-places/{id}', [NewEnglandController::class, 'update'])->name('NewEnglandplace.update');

});

// auth part------------------------------------------------------------------------------------------------------------>>>
Route::get('/login', [loginController::class, 'showLoginForm'])->name('login');
Route::post('/authenticate', [loginController::class, 'authenticate'])->name('authenticate'); 
Route::get('/register', [loginController::class, 'showregisterForm'])->name('register');
Route::post('/registerUser', [loginController::class, 'registerUser'])->name('registerUser'); 
Route::get('/logout', [loginController::class, 'logout'])->name('logout'); 
// 
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');


// it render the webpage or main contain 
Route::get('/',[NewEnglandController::class,'newEnglandMap'])->name('NewEnglandmap');


//new england map without header/footer route
Route::get('/new',[NewEnglandController::class,'newEnglandMapNew'])->name('NewEnglandmapNew');


Route::get('/load-external', function () {
    $externalUrl = 'https://preventionmap.nehidta.org/public/new';
    
    $response = Http::get($externalUrl);

    return response($response->body())
        ->header('Content-Type', 'text/html')
        ->header('X-Frame-Options', ''); 
});
