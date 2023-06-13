<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Sales;
use App\Http\Middleware\Hr;

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

Auth::routes();

//Auth::logout();

Route::get('/home', function () {
    return view('admin-lte.mainadmin');
});

Route::get('adduser',[UserController::class,'adduser'])->name('adduser')->middleware('Admin');

Route::post('insertuser',[UserController::class,'store'])->name('insertuser')->middleware('Admin');

Route::get('listuser',[UserController::class,'index'])->name('listuser');
    
    Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit')->middleware('Admin');

    Route::post('/update/{id}',[UserController::class,'update'])->name('update')->middleware('Admin');

    Route::post('/delete/{id}',[UserController::class,'destroy'])->name('delete')->middleware('Admin');

//Inquiry Routes

Route::get('addinquiry',[InquiryController::class,'addinquiry'])->name('addinquiry')->middleware('Sales');

Route::post('insertinquiry',[InquiryController::class,'store'])->name('insertinquiry')->middleware('Sales');

Route::get('listinquiry',[InquiryController::class,'index'])->name('listinquiry');

Route::post('/deleteinquiry/{id}',[InquiryController::class,'destroy'])->name('deleteinquiry')->middleware('Sales');

Route::get('/editinquiry/{id}',[InquiryController::class,'edit'])->name('editinquiry')->middleware('Sales');

Route::post('/updateinquiry/{id}',[InquiryController::class,'update'])->name('updateinquiry')->middleware('Sales');

 // Auth::logout();