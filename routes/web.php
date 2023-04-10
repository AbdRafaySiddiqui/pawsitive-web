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
Route::get('api/dogs', 'App\Http\Controllers\ApisController@AjaxDogs');
Route::get('api/fe_dog', 'App\Http\Controllers\ApisController@AjaxDog_Fe');
Route::post('/submit-form', 'App\Http\Controllers\EventsController@submitForm');
Route::post('/event-dog', 'App\Http\Controllers\EventResultsController@dog_submit');
Route::post('/submit-Dogform', 'App\Http\Controllers\DogsController@storeMale');
Route::post('/submit-Dogform-Female', 'App\Http\Controllers\DogsController@storeFemale');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    
    Route::resource('event_results','App\Http\Controllers\EventResultsController');
    Route::resource('club','App\Http\Controllers\ClubsController');
    Route::resource('judges','App\Http\Controllers\JudgesController');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('dogs','App\Http\Controllers\dogsController');
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::put('/users/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('judges',App\Http\Controllers\JudgesController::class);
    Route::put('/judges/{id}/update', [App\Http\Controllers\JudgesController::class, 'update'])->name('judges.update');
    Route::delete('/judges/{id}/delete', [App\Http\Controllers\JudgesController::class, 'destroy'])->name('judges.destroy');
    Route::get('/events/{eventId}/details', 'App\Http\Controllers\EventsController@details')->name('event_details');
    Route::get('/clubs/{clubId}', 'App\Http\Controllers\ClubsController@club_details')->name('club_details');







    Route::resource('breeds',App\Http\Controllers\BreedsController::class);
    Route::put('/breeds/{id}/update', [App\Http\Controllers\BreedsController::class, 'update'])->name('breeds.update');
    Route::delete('/breeds/{id}/delete', [App\Http\Controllers\BreedsController::class, 'destroy'])->name('breeds.destroy');

    Route::post('/users', 'App\Http\Controllers\UserController@store')->name('users.store');
    Route::resource('breeds','App\Http\Controllers\breedsController');
    Route::resource('events','App\Http\Controllers\EventsController');
    Route::resource('event_result','App\Http\Controllers\EventResultsController');
    Route::resource('akc_groups','App\Http\Controllers\AKCGroupController');
    Route::resource('fci_groups','App\Http\Controllers\FCIGroupController');
    Route::resource('species','App\Http\Controllers\SpeciesController');
    Route::get('breeds/{id}/destroy', [App\Http\Controllers\BreedsController::class, 'destroy'])->name('br_del');
    Route::post('breeds/{id}/update', [App\Http\Controllers\BreedsController::class, 'update'])->name('br_up');
    Route::post('breeds/{id}/upload-profile-picture', [App\Http\Controllers\BreedsController::class, 'upload_profile_picture'])->name('breed_up_pp');
    Route::post('breeds/{id}/upload-images', [App\Http\Controllers\BreedsController::class, 'upload_images'])->name('breed_up_imgs');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});