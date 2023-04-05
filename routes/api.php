<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('breed-listings', [App\Http\Controllers\API\BreedController::class, 'listing']);
Route::get('breed/{id}/details', [App\Http\Controllers\API\BreedController::class, 'details']);

// Judges Controller.
Route::get('judge-listings', [App\Http\Controllers\API\JudgeController::class, 'listing']);
Route::get('judge/{id}/details', [App\Http\Controllers\API\JudgeController::class, 'details']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
