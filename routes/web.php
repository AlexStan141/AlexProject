<?php

use App\Http\Controllers\ProfileController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route('main.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function(){
    return view('main.index');
})->middleware(['auth', 'verified'])->name('main.index');

Route::get('/clients', function () {
    $clients = Client::with('user');
    $clients->when(request('search'), function ($query) {
        $query->where('full_name', 'like', '%' . request('search') . '%')
            ->orWhereHas('user', function($query){
                $query->where('email', 'like', '%' . request('search') . '%');
            });
    })->when(request('sort'), function ($query) {
        if (request('sort') === 'az') {
            $query->orderBy('full_name');
        } else if (request('sort') === 'za') {
            $query->orderBy('full_name', 'desc');
        }
    });
    return view('main.clients', [
        'clients' => $clients->get()
    ]);
})->middleware(['auth', 'admin'])->name('main.clients');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
