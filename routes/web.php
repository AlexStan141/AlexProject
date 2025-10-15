<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Models\Client;

Route::get('', fn() => to_route('client.index'));

Route::get('/clients', function () {
    return view('clients');
});

Route::resource('client', ClientController::class);
