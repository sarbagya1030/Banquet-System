<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthenticationController;
use App\Http\Controllers\upload_details;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[CustomAuthenticationController::class,'login']) -> middleware('alreadyLoggedIn');
Route::get('/registration',[CustomAuthenticationController::class,'registration'])-> middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomAuthenticationController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthenticationController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomAuthenticationController::class,'dash']) -> middleware('isLoggedIn');
Route::get('/dashboardOwner',[CustomAuthenticationController::class,'dashOwner']) -> middleware('isLoggedIn');
// Route::get('/dashboardOwner',[CustomAuthenticationController::class,'dashboard']) -> middleware('isLoggedIn');

Route::get('/logout',[CustomAuthenticationController::class,'logout']);
Route::get('/banquetRegister',[CustomAuthenticationController::class,'banquetRegister']);
Route::post('/register-owner',[CustomAuthenticationController::class,'registerOwner'])->name('register-owner');

Route::get('/profile',[CustomAuthenticationController::class,'profile']);
Route::put('/profileUpdateUser',[CustomAuthenticationController::class,'updateProfileUser'])->name('profileUpdateUser');

Route::get('/details',[upload_details::class,'detail'])->name('details');
// Route::post('/details',[upload_details::class,'store'])->name('addDetails');
