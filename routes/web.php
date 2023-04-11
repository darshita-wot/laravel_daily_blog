<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');
});

Route::post('/registration',[UserController::class,'userRegistration']);
Route::post('/login',[UserController::class,'userLogin']);

Route::post('/forgotpassword', [UserController::class, 'forgotPassword']);

Route::get('/resetpassword', [UserController::class, 'loadResetPassword']);
Route::post('/resetpassword', [UserController::class, 'resetPassword']);

Route::get('/home',function(){
    return view('layout.home');
});

Route::get('logout',[UserController::class,'logout']);

Route::get('/myprofileview',[UserController::class,'getProfileView']);
Route::post('/myprofileupdate',[UserController::class,'profileupdate']);

Route::get('/users',function(){
    return view('admin/users');
});

Route::post('/userlist',[App\Http\Controllers\Admin\UserController::class,'userList']);
Route::get('/edituser',[App\Http\Controllers\Admin\UserController::class,'editUser']);
Route::post('/updateuser',[App\Http\Controllers\Admin\UserController::class,'updateUser']);
Route::get('/userdelete',[App\Http\Controllers\Admin\UserController::class,'deleteUser']);

Route::post('/taglist',[TagController::class,'tagList']);
Route::resource('tags', TagController::class);