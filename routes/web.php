<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\welcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\checkAge;
use App\Models\Brand;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\DB;

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
    $brands = Brand::all();
    return view('welcome',compact('brands'));
});


//Admin index
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


// Email Verification 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


//Logout
Route::get('/user/logout',[UserController::class, 'Logout'])->name('user.logout');


// ---------->Brand<----------

//All Brand
Route::get('/brand/all',[BrandController::class, 'allBrand'])->name('all.brand');

//Brand Add
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('add.brand');

//Brand Edit
Route::get('brand/edit/{id}', [BrandController::class, 'editBrand']);

//Brand Update
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);

//Brand Delete
Route::get('/brand/delete/{id}',[BrandController::class, 'deleteBrand']);

// ----------> Home Slider <----------

//All Sliders
Route::get('/home/slider',[welcomeController::class, 'homeSlider'])->name('home.slider');

//Add slider view
Route::get('/slider/add', function(){
    return view('admin.homeSlider.addSlider');
})->name('slider.add');

//Slider Add
Route::post('/slider/add', [welcomeController::class, 'addSlider'])->name('add.slider');

//Slider Edit
Route::get('slider/edit/{id}', [welcomeController::class, 'editSlider']);

//Slider Update
Route::post('/slider/update/{id}', [welcomeController::class, 'updateSlider']);

//Slider Delete
Route::get('/slider/delete/{id}',[welcomeController::class, 'deleteSlider']);


