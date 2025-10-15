<?php

use Illuminate\Support\Facades\Route;
use App\Models\Client;

Route::get('/', function () {
    $clients = Client::query();
    $clients->when(request('search'), function($query){
        $query->where('client_name', 'like', '%' . request('search') . '%')
              ->orWhere('email', 'like', '%' . request('search') . '%');
    });
    return view('home',[
        'clients' => $clients->get()
    ]);
});

Route::get('/clients', function () {
    return view('clients');
});
