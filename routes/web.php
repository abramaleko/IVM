<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::resource('invoice',InvoiceController::class)
->except('index','create');

Auth::routes([ 'register'=> false,]);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
