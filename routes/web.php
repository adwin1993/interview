<?php

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


Route::get('/', [App\Http\Controllers\LinksController::class, 'index']);    // home page
Route::get('/index', [App\Http\Controllers\LinksController::class, 'index'])->name('index');    // home page
Route::post('/create', [App\Http\Controllers\LinksController::class, 'create'])->name('create');    // create shorten url
Route::get('shortenLink/{id}', [App\Http\Controllers\LinksController::class, 'shortenLink'])->name('shortenLink'); // redirect to original url
