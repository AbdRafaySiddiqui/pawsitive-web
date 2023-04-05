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



Route::get('api/search', 'App\Http\Controllers\ApisController@dataAjax');
Route::get('api/dog', 'App\Http\Controllers\ApisController@AjaxDog');
Route::get('api/fe_dog', 'App\Http\Controllers\ApisController@AjaxDog_Fe');
Route::post('/submit-form', 'App\Http\Controllers\EventsController@submitForm');
Route::post('/submit-Dogform', 'App\Http\Controllers\DogsController@storeMale');
Route::post('/submit-Dogform-Female', 'App\Http\Controllers\DogsController@storeFemale');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::resource('club','App\Http\Controllers\ClubsController');
    Route::resource('judges','App\Http\Controllers\JudgesController');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('dogs','App\Http\Controllers\DogsController');
    Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/users/{id}/edit', 'App\Http\Controllers\UserController@edit')->name('users.edit');
    Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');



    Route::post('/users', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('events','App\Http\Controllers\EventsController');
    Route::resource('akc_groups','App\Http\Controllers\akc_group');
    Route::resource('fci_groups','App\Http\Controllers\fci_group');
    Route::resource('species','App\Http\Controllers\SpeciesController');
    Route::get('breeds/{id}/destroy', [App\Http\Controllers\BreedsController::class, 'destroy'])->name('br_del');
    Route::post('breeds/{id}/update', [App\Http\Controllers\BreedsController::class, 'update'])->name('br_up');
    Route::post('breeds/{id}/upload-profile-picture', [App\Http\Controllers\BreedsController::class, 'upload_profile_picture'])->name('breed_up_pp');
    Route::post('breeds/{id}/upload-images', [App\Http\Controllers\BreedsController::class, 'upload_images'])->name('breed_up_imgs');
    
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