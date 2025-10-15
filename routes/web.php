<?php

use Illuminate\Support\Facades\Route;
use App\Models\Client;

Route::get('/', function () {
    $clients = Client::query();
    $clients->when(request('search'), function($query){
        $query->where('client_name', 'like', '%' . request('search') . '%')
              ->orWhere('email', 'like', '%' . request('search') . '%');
    })->when(request('sort'), function($query){
        if(request('sort') === 'az'){
            $query->orderBy('client_name');
        }
        else if(request('sort') === 'za'){
            $query->orderBy('client_name', 'desc');
        }
    });
    return view('home',[
        'clients' => $clients->get()
    ]);
});

Route::get('/clients', function () {
    return view('clients');
});
