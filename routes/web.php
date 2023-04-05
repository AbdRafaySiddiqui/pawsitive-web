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


Route::get('/', function () {
    return redirect()->route('dashboard');
});



Route::get('api/search', [App\Http\Controllers\ApisController::class, 'dataAjax']);
Route::get('api/dog', [App\Http\Controllers\ApisController::class, 'AjaxDog']);
Route::get('api/fe_dog', [App\Http\Controllers\ApisController::class, 'AjaxDog_Fe']);
Route::post('/submit-form', [App\Http\Controllers\EventsController::class, 'submitForm']);
Route::post('/submit-Dogform', [App\Http\Controllers\DogsController::class, 'storeMale']);
Route::post('/submit-Dogform-Female', [App\Http\Controllers\DogsController::class, 'storeFemale']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::resource('club',App\Http\Controllers\ClubsController::class);
    Route::put('/club/{id}/update', [App\Http\Controllers\ClubsController::class, 'update'])->name('club.update');
    Route::delete('/club/{id}/delete', [App\Http\Controllers\ClubsController::class, 'destroy'])->name('club.destroy');

    Route::resource('judges',App\Http\Controllers\JudgesController::class);
    Route::put('/judges/{id}/update', [App\Http\Controllers\JudgesController::class, 'update'])->name('judges.update');
    Route::delete('/judges/{id}/delete', [App\Http\Controllers\JudgesController::class, 'destroy'])->name('judges.destroy');

    Route::resource('breeds',App\Http\Controllers\BreedsController::class);
    Route::put('/breeds/{id}/update', [App\Http\Controllers\BreedsController::class, 'update'])->name('breeds.update');
    Route::delete('/breeds/{id}/delete', [App\Http\Controllers\BreedsController::class, 'destroy'])->name('breeds.destroy');

    Route::resource('dogs',App\Http\Controllers\DogsController::class);
    Route::put('/dogs/{id}/update', [App\Http\Controllers\DogsController::class, 'update'])->name('dogs.update');
    Route::delete('/dogs/{id}/delete', [App\Http\Controllers\DogsController::class, 'destroy'])->name('dogs.destroy');

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::put('/users/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    
    Route::resource('events',App\Http\Controllers\EventsController::class);
    Route::resource('akc_groups',App\Http\Controllers\AKCGroupController::class);
    Route::resource('fci_groups',App\Http\Controllers\FCIGroupController::class);
    // Route::resource('species','App\Http\Controllers\SpeciesController');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});