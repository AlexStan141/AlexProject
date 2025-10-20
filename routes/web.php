<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\UserRequest;
use App\Models\Client;
use App\Models\User;
use App\Models\Admin as AdminModel;
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
        return view('admin.create', [
            'status' => old('status', null)
        ]);
    })->name('admin.create');

    Route::post('/admin/clients', function(ClientRequest $request){

        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['full_name'],
            'email' => $validated['user']['email'],
            'password' => bcrypt($validated['user']['password'])
        ]);

        Client::create([
            'full_name' => $validated['full_name'],
            'phone' => $validated['phone'],
            'company_name' => $request->input('company_name'),
            'address' => $request->input('address'),
            'notes' => $request->input('notes'),
            'status' => $validated['status'],
            'user_id' => $user->id
        ]);

        return redirect() -> route('admin.clients')->with('success', 'Account added successfully!');

    })->name('admin.store');

    Route::get('/admin/clients/{id}/edit', function($id){

        if($id == '1'){
            $userToEdit = AdminModel::findOrFail($id);
        } else {
            $userToEdit = Client::findOrFail($id - 1);
        }
        return view("admin.edit", ['client' => $userToEdit]);

    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
