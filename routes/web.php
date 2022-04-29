<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\BannerController;
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

Route::get('/vendor', function(){
    return redirect()->route('admin-dashboard');
});
//form
Route::prefix('form')
->group(function(){
    Route::get('/vendor/{id}',[FormController::class, 'index'])->name('form');
    Route::post('/postdata',[FormController::class, 'postdata'])->name('form-post');
    Route::get('/thankyou',[FormController::class, 'thankyou'])->name('form-thankyou');
});

//dasahboard
Route::prefix('dashboard')
->middleware(['auth:sanctum','vendor'])
->group(function(){
    Route::get('/',[DashboardController::class, 'index'])->name('admin-dashboard');
    Route::resource('client',ClientController::class);
    Route::resource('banner',BannerController::class);
});

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
