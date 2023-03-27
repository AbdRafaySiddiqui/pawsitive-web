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
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::resource('club','App\Http\Controllers\ClubsController');
Route::resource('judges','App\Http\Controllers\judgesController');
Route::resource('breeds','App\Http\Controllers\breedsController');
Route::resource('dogs','App\Http\Controllers\dogsController');
Route::resource('events','App\Http\Controllers\EventsController');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
