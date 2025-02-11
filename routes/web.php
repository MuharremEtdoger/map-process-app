<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationsController;


Route::get('/', function () {
    return view('index');
});
