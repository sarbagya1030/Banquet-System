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

Route::get('/login',[CustomAuthenticationController::class,'login']) -> middleware('alreadyLoggedIn')->name('login');
Route::get('/registration',[CustomAuthenticationController::class,'registration'])-> middleware('alreadyLoggedIn');
Route::post('/register-user',[CustomAuthenticationController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthenticationController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomAuthenticationController::class,'dash']) -> middleware('isLoggedIn');
Route::get('/dashboardOwner',[CustomAuthenticationController::class,'dashOwner']) -> middleware('isLoggedIn') -> name('dashboardOwner');
// Route::get('/dashboardOwner',[CustomAuthenticationController::class,'dashboard']) -> middleware('isLoggedIn');

Route::get('/logout',[CustomAuthenticationController::class,'logout'])->name('logout');
Route::get('/banquetRegister',[CustomAuthenticationController::class,'banquetRegister']);
Route::post('/register-owner',[CustomAuthenticationController::class,'registerOwner'])->name('register-owner');

Route::get('/profile',[CustomAuthenticationController::class,'profile']);
Route::put('/profileUpdateUser',[CustomAuthenticationController::class,'updateProfileUser'])->name('profileUpdateUser');
Route::delete('/deleteUser-profile/{email}',[upload_details::class,'deleteuserProfile'])->name('deleteUser-profile');

Route::get('/create-record',[upload_details::class,'recordupdate'])->name('create-record');
Route::post('/menu/{email}',[upload_details::class,'menus'])->name('menu');
Route::post('/date/{email}',[upload_details::class,'dates'])->name('date');
Route::post('/image/{email}',[upload_details::class,'images'])->name('image');
Route::post('/capacity/{email}',[upload_details::class,'capacities'])->name('capacity');

Route::get('/profile-owner',[upload_details::class,'viewprofileOwner'])->name('profile-owner');
Route::put('/updateProfile-owner',[upload_details::class,'profileUpdateOwner'])->name('updateProfile-owner');

Route::get('/dates-view',[upload_details::class,'dateView'])->name('dates-view');
Route::get('/menu-view',[upload_details::class,'menuView'])->name('menu-view');
Route::get('/capacity-view',[upload_details::class,'capacityView'])->name('capacity-view');

Route::delete('/deleteImage-banquet/{id}',[upload_details::class,'deleteImages'])->name('deleteImage-banquet');
Route::delete('/deleteDate-banquet/{id}',[upload_details::class,'deleteDates'])->name('deleteDate-banquet');
Route::delete('/deleteFood-banquet/{id}',[upload_details::class,'deleteFoods'])->name('deleteFood-banquet');
Route::delete('/deleteCapacity-banquet/{id}',[upload_details::class,'deleteCapacities'])->name('deleteCapacity-banquet');

Route::delete('/deleteOwner-profile/{email}',[upload_details::class,'deleteownerProfile'])->name('deleteOwner-profile');

Route::get('/emailVerify', [CustomAuthenticationController::class, 'emailVerifyGet'])->name('email.verify.get');
Route::post('/email-verify', [CustomAuthenticationController::class, 'emailVerifyPost'])->name('email.verify.post');
Route::get('/password-reset/{token}', [CustomAuthenticationController::class, 'passwordResetGet'])->name('password.reset.get');
Route::post('/password-reset', [CustomAuthenticationController::class, 'passwordResetPost'])->name('password.reset.post');

Route::get('/booking/{id}',[upload_details::class,'booknow'])->name('booking');

Route::post('/book-order/{id}',[upload_details::class,'bookingform'])->name('book-order');