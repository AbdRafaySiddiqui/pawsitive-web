<?php

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


// Route::get('/login', function () {
//     return view('auth_login');
// });
// Route::get('/for', function () {
//     return view('club.store');
// });


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::resource('club','App\Http\Controllers\clubController');
    Route::resource('judges','App\Http\Controllers\judgesController');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('dogs','App\Http\Controllers\dogsController');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
