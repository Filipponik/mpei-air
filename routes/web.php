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

Route::get('flight', function() {
    return Inertia::render('Flight');
})->name('flight');

Route::get('parking-zone', function() {
    return Inertia::render('ParkingZone');
})->name('parkingzone');

Route::get('cafe-and-shops', function() {
    return Inertia::render('CafeShops');
})->name('cafeshops');

Route::get('how-to-get-to', function() {
    return Inertia::render('HowToGetTo');
})->name('howtogetto');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
