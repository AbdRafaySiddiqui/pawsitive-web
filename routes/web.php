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


// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('/for', function () {
//     return view('club.store');
// });

Route::get('api/search', 'App\Http\Controllers\ApisController@dataAjax');
Route::post('/submit-form', 'App\Http\Controllers\EventsController@submitForm');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    
    Route::resource('club','App\Http\Controllers\ClubsController');
    Route::resource('judges','App\Http\Controllers\judgesController');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('dogs','App\Http\Controllers\dogsController');
    Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/users/{id}/edit', 'App\Http\Controllers\UserController@edit')->name('users.edit');
    Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');



    Route::post('/users', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('events','App\Http\Controllers\EventsController');

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