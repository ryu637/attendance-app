<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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
    return view('event.create');
});
Route::post('/api/event', [EventController::class, 'store']);

Route::get('/event/{eventToken}', function ($eventToken) {
    return view('event.show', ['eventToken' => $eventToken]);
});

Route::get('/event/detail/{eventToken}', function ($eventToken) {
    return view('event.detail', ['eventToken' => $eventToken]);
});

Route::get('/api/event/detail/token/{eventToken}', [EventController::class, 'showByToken']);
Route::post('/api/event/participant/token/{eventId}',[EventController::class, 'storeParticipant']);