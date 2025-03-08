<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/deal-cards', [CardController::class, 'dealCards']);
