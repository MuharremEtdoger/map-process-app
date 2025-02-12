<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationsController;

Route::middleware(['throttle:globLimiterTwentyPerMinute'])->group(function () {

    Route::get('/', function () {
        return view('index');
    });
    Route::get('/add-location', [LocationsController::class, 'addLocation']);
    Route::post('/add-location', [LocationsController::class, 'addLocationPost']);
    Route::get('/update-location/{id}', function (string $id) {
        return LocationsController::updateLocation($id);
    });
    Route::post('/update-location/{id}', [LocationsController::class, 'updateLocationPost']);
    Route::get('/locations', [LocationsController::class, 'listLocations']);
    Route::get('/location/{id}', function (string $id) {
        return LocationsController::getSingleLocation($id);
    });
    Route::get('/create-route/{id}', function (string $id) {
        return LocationsController::createRoute($id);
    });
    Route::post('/create-route/{id}', [LocationsController::class, 'createRoutePost']);

});


