<?php

use App\Http\Controllers\ProfileController;
use App\Models\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('client.dashboard');
    }
})->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

Route::get('/client/dashboard', function () {
    return view('client.dashboard');
})->middleware(['auth', 'verified'])->name('client.dashboard');

Route::get('/admin/clients', function () {
    $clients = Client::with('user');
    $clients->when(request('search'), function ($query) {
        $query->where('full_name', 'like', '%' . request('search') . '%')
            ->orWhereHas('user', function ($query) {
                $query->where('email', 'like', '%' . request('search') . '%');
            });
    })->when(request('sort'), function ($query) {
        if (request('sort') === 'az') {
            $query->orderBy('full_name');
        } else if (request('sort') === 'za') {
            $query->orderBy('full_name', 'desc');
        }
    });
    return view('admin.clients', [
        'clients' => $clients->get()
    ]);
})->middleware(['auth', 'verified', 'admin'])->name('admin.clients');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/clients/create', function () {
        return view('admin.create');
    })->name('admin.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
