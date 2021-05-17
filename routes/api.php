<?php

namespace App\Http\Controllers\Api;
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
Route::group(['prefix' => 'flights'], function () {
    Route::get('/', [FlightController::class, 'flights']);
    Route::get('/{code}', [FlightController::class, 'flightByCode']);
});

Route::group(['prefix' => 'tickets', 'middleware' => 'auth:sanctum'], function() {
    Route::post('buy', [TicketController::class, 'buyTicket']);
});

Route::group(['prefix' => 'tariffs'], function () {
    Route::get('/', [TariffController::class, 'tariffs']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
