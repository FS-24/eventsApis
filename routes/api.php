<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('events', [EventController::class, 'index'])->name('event.all');;
Route::post('events/participation', [EventController::class, 'participate'])->name('event.participation');
Route::get('events/{id}/participants', [EventController::class, 'getParticipantes'])->name('event.participants');
Route::get('users/{id}/events', [EventController::class, 'getAllEvents'])->name('event.attended');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('verification/{id}', [AuthController::class, 'emailVerification'])->name('email.verification');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});