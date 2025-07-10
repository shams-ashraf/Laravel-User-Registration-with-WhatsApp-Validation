<?php

use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
use App\Http\Controllers\RegistrationController;

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::get('/check-username', [RegistrationController::class, 'checkUsername'])->name('check.username');

Route::get('/testroute',function(){
    $user = new User(
        [
            'full_name' => 'Mohamed Magdy',
            'user_name' => 'magibra490',
            'phone_number' => '0123456789',
            'whatsapp_number' => '0123456789',
            'address' => 'Cairo, Egypt',
            'password' => bcrypt('password'),
            'email' => 'maibra490@gmail.com',
            'img_name' => 'profile.jpg'
        ]
    );


    Mail::to('magibra490@gmail.com')->send (new MyTestEmail($user));
    return 'Email sent successfully';
});