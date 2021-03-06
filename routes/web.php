<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('liveboard', function() {
    return Inertia::render('Liveboard');
})->name('liveboard');

Route::group(['prefix' => 'flight'] , function () {
    Route::get('/', function() {
        return Inertia::render('Flight');
    })->name('flight');

    Route::get('{code}', function($code) {
        return Inertia::render('FlightCard', [
            'flight_code' => $code,
        ]);
    })->name('flightcard');

    Route::get('{code}/buy', function($code) {
        return Inertia::render('BuyTicket', [
            'flight_code' => $code,
        ]);
    })->name('buyticket');
});

Route::middleware(['auth:sanctum', 'verified'])->get('buy-history', function() {
    return Inertia::render('BuyHistory');
})->name('buyhistory');

Route::get('parking-zone', function() {
    return Inertia::render('ParkingZone');
})->name('parkingzone');

Route::get('cafe-and-shops', function() {
    return Inertia::render('CafeShops');
})->name('cafeshops');

Route::group(['prefix' => 'support'], function() {
    Route::get('/', function() {
        return Inertia::render('Support');
    })->name('support');

    Route::middleware(['auth:sanctum', 'verified'])->get('/list', function () {
        return Inertia::render('FeedbackList');
    })->name('feedbacklist');
    
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
