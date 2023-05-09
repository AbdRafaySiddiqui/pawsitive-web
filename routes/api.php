<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BreedController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\MiscController;
use App\Http\Controllers\API\TrainerController;
use App\Http\Controllers\API\PetsController;
use App\Http\Controllers\API\DogController;
use App\Http\Controllers\API\ClubController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\EventResultController;
use App\Http\Controllers\API\SubscriptionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/





// Breeds Controller.
Route::get('breed-listings', [App\Http\Controllers\API\BreedController::class, 'listing']);//working fine.
Route::get('breed/{id}/details', [App\Http\Controllers\API\BreedController::class, 'details']);//working fine.
Route::get('breed-short', [BreedController::class, 'breed_short']);//working fine.
Route::get('breed-names', [BreedController::class, 'retrieve']);//working fine.
Route::get('breed/{id}/info', [BreedController::class, 'breed_info']);//working fine.

Route::get('/cities/{idcountry}', [App\Http\Controllers\API\CitiesController::class, 'getCities']);


// Subscription Controller.
Route::post('add-subscription', [App\Http\Controllers\API\SubscriptionController::class, 'add']);

//contact
Route::post('contact', [App\Http\Controllers\API\ContactController::class, 'add']);

// Judges Controller.
Route::get('judge-listings', [App\Http\Controllers\API\JudgeController::class, 'listing']);//working on live.
Route::get('judge/{id}/details', [App\Http\Controllers\API\JudgeController::class, 'details']);//working fine.
Route::get('/judges/{judgeId}', 'App\Http\Controllers\API\JudgeController@judge_details')->name('judge_details'); //working fine.

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//DogController routes
Route::get('dog/{breed_id}/listings', [DogController::class, 'listing']);//working fine.
Route::get('add/image', [DogController::class, 'add']);//working fine.
Route::get('dog/{id}/details', [DogController::class, 'details']);//working fine.
Route::get('dog/all-dogs', [DogController::class, 'alldogs']);//working fine.
Route::get('dog/breed-dogs', [DogController::class, 'breed_dog'])->name('breed-dogs');//working fine.
Route::get('dog/dog-profile', [DogController::class, 'dog_profile']);//working fine.
Route::get('dog/{id}/profile-details', [DogController::class, 'profile_details']);//dog_owner table doesnt exist.

//EventResultController routes
Route::get('result-listing', [EventResultController::class, 'result']);
Route::get('event/{id}/result', [EventResultController::class, 'event_result']);
Route::get('event_results/judge', [EventResultController::class, 'judge'])->name('event_judge');

//EventController routes
Route::get('event-listing/{breed_id}', [App\Http\Controllers\API\EventController::class, 'retrieve']);//working fine.
Route::get('/events/filter', [App\Http\Controllers\API\EventController::class, 'filterEvents']);//working fine.
Route::get('/champions-listing/{breed_id}', [App\Http\Controllers\API\EventController::class, 'champions']);//Models added now working fine working fine on live.

//ClubController routes
Route::get('club-listings', [ClubController::class, 'listing']);//working fine.
Route::get('club/{id}/details', [ClubController::class, 'details']);//address and website clause removed working fine on live.
Route::get('club-names', [ClubController::class, 'retrieve']);//working fine.

//CountryController API.
Route::get('/countries/{countryId}', 'App\Http\Controllers\API\CountriesController@country_details')->name('country_details');//working fine.

//MiscController routes
Route::get('countries', [MiscController::class, 'countries']);//working fine.
Route::get('cities', [MiscController::class, 'cities']);//working fine.
Route::get('species', [MiscController::class, 'species']); //not working db sp_id not found theres no species table.
Route::get('instagram-api', [MiscController::class, 'instagram_api']); // variable error.
Route::get('statistic', [MiscController::class, 'statistic']);//working fine.

Route::post('instagram-api-response-reader', [MiscController::class, 'instagram_api_response_reader']);//googlesearch namespace require.


// For Admin Panel use
Route::post('countries/cities', [MiscController::class, 'cities_by_countries'])->name('cities_by_countries');//working fine.
Route::get('import-data', [MiscController::class, 'import_data']);

Route::post('upgrade-as-trainer', [MiscController::class, 'upgrade_as_trainer']);
Route::post('upgrade-as-vet', [MiscController::class, 'upgrade_as_vet']);

// For Admin Panel use
Route::post('species/breeds', [BreedController::class, 'get_by_species'])->name('get_by_species');
Route::post('breeds/pets', [BreedController::class, 'pets_by_breed'])->name('pets_by_breed');

//TrainerController routes
Route::get('trainers', [TrainerController::class, 'listing']);
Route::get('trainer/{id}/details', [TrainerController::class, 'details']);
Route::post('rate-trainer', [TrainerController::class, 'rate_trainer']);
Route::get('my-trainer-profile', [TrainerController::class, 'my_trainer_profile']);
Route::post('update-trainer-profile', [TrainerController::class, 'update_trainer_profile']);
Route::post('add-trainer-images', [TrainerController::class, 'add_trainer_images']);
Route::get('delete-trainer-image', [TrainerController::class, 'delete_trainer_images']);
Route::post('add-trainer-videos', [TrainerController::class, 'add_trainer_videos']);
Route::get('delete-trainer-video', [TrainerController::class, 'delete_trainer_videos']);

//PetsController routes
Route::get('my-pets/{id}', [PetsController::class, 'index']);//models not created.
Route::post('add-pet', [PetsController::class, 'store']);//models not created.
Route::get('pet/{id}/details', [PetsController::class, 'show']);//models not created.

//MemberController routes
Route::get('member/{id}/details', [MemberController::class, 'user_profile']);//working fine after changes on live.
Route::get('my-profile', [MemberController::class, 'my_profile']);//empty array response after changes.
Route::post('update-profile', [MemberController::class, 'update_profile']);

//VetController routes
Route::get('vets', [VetController::class, 'listing']);
Route::get('vet/{id}/details', [VetController::class, 'details']);
Route::post('rate-vet', [VetController::class, 'rate_vet']);
Route::post('send-appointment-request', [VetController::class, 'send_appointment_request']);
Route::post('confirm-appointment-request', [VetController::class, 'confirm_appointment_request']);
Route::post('complete-appointment-request', [VetController::class, 'complete_appointment_request']);
Route::post('cancel-appointment-request', [VetController::class, 'cancel_appointment_request']);
Route::get('my-vet-profile', [VetController::class, 'my_vet_profile']);
Route::get('all-appointments', [VetController::class, 'all_appointments']);
Route::get('appointment/{id}/details', [VetController::class, 'view_appointment_normal']);
Route::get('appointment/{id}/history', [VetController::class, 'view_appointment_with_history']);
Route::post('update-vet-profile', [VetController::class, 'update_vet_profile']);
