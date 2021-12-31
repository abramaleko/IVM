<?php

use App\Http\Livewire\CornProject;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\NewInvoice;
use App\Http\Livewire\PendingInvoices;
use App\Http\Livewire\RearingProject;
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


Route::permanentRedirect('/', '/login');



Auth::routes([ 'register'=> false,]);


Route::get('/invoice/new', NewInvoice::class)
->middleware('auth')
->name('new-invoice');


Route::get('/invoice/pending', PendingInvoices::class)
->middleware('auth')
->name('pending-invoice');


Route::get('/invoice/processed/chicken_rearing/{filter?}/{range?}', RearingProject::class)
->middleware('auth')
->name('rearing-project');

Route::get('/invoice/processed/corn_project/{filter?}/{range?}', CornProject::class)
->middleware('auth')
->name('corn-project');

Route::get('/home', Dashboard::class)
->middleware('auth')
->name('home');

