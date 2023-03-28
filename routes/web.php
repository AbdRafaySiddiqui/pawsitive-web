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
    Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', 'App\Http\Controllers\UserController@store')->name('users.store');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['role:admin'])->group(function () {
    // This route can only be accessed by users with the "admin" role
    Route::get('/clubs/create', [ClubController::class, 'create']);
});

Route::middleware(['role:writer', 'permission:create club'])->group(function () {
    // This route can only be accessed by users with the "writer" role and the "create club" permission
    Route::post('/clubs', [ClubController::class, 'store']);
});
