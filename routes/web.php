<?php

use App\Http\Controllers\ProfileController;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use App\Models\Admin as AdminModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
    Gate::authorize('view', AdminModel::class);
    return view('admin.show', ['admin' => Auth::user()->admin]);
})->name('admin.dashboard');

Route::get('/client/dashboard', function () {
    Gate::authorize('view', Auth::user()->client);
    return view('client.show', ['client' => Auth::user()->client]);
})->middleware(['auth', 'verified'])->name('client.dashboard');

Route::get('/admin/clients', function () {
    Gate::authorize('viewAny', Client::class);
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
    return view('client.index', [
        'clients' => $clients->get()
    ]);
})->name('admin.clients');


Route::get('/admin/{admin}/edit', function (AdminModel $admin) {
    Gate::authorize('update', $admin);
    return view('admin.edit', ['admin' => $admin]);
})->name('admin.edit');

Route::get('/client/{client}/edit', function (Client $client) {
    Gate::authorize('update', $client);
    return view('client.edit', ['client' => $client]);
})->name('client.edit.user');

Route::put('/admin/{admin}', function (AdminModel $admin, AdminRequest $request) {
    Gate::authorize('update', $admin);
    $validated = $request->validated();
    $user = $admin->user;
    $user->update([
        'name' => $validated['full_name'],
        'email' => $validated['user']['email'],
    ]);
    if (!empty($validated['user']['password'])) {
        $user->update([
            'password' => bcrypt($validated['user']['password']),
        ]);
    }
    $admin->update([
        'full_name' => $validated['full_name'],
        'phone' => $validated['phone'],
        'company_name' => $request->input('company_name'),
        'address' => $request->input('address'),
        'notes' => $request->input('notes'),
        'status' => $validated['status'],
    ]);
    return redirect()->route('admin.dashboard')->with('success', 'Account updated successfully!');
})->name('admin.update');

Route::put('/client/{client}', function (Client $client, ClientRequest $request) {
    Gate::authorize('update', $client);
    $validated = $request->validated();
    $user = $client->user;
    $user->update([
        'name' => $validated['full_name'],
        'email' => $validated['user']['email'],
    ]);
    if (!empty($validated['user']['password'])) {
        $user->update([
            'password' => bcrypt($validated['user']['password']),
        ]);
    }
    $client->update([
        'full_name' => $validated['full_name'],
        'phone' => $validated['phone'],
        'company_name' => $request->input('company_name'),
        'address' => $request->input('address'),
        'notes' => $request->input('notes'),
        'status' => $validated['status'],
    ]);
    return redirect()->route('client.dashboard')->with('success', 'Account updated successfully!');
})->name('client.update.user');

Route::get('/admin/clients/{client}/edit', function (Client $client) {
    Gate::authorize('update', $client);
    return view("client.edit", ['client' => $client]);
})->name("client.edit.admin");

Route::put('/admin/clients/{client}', function (ClientRequest $request, Client $client) {
    Gate::authorize('update', $client);
    $validated = $request->validated();
    $user = $client->user;
    $user->update([
        'name' => $validated['full_name'],
        'email' => $validated['user']['email'],
    ]);
    if (!empty($validated['user']['password'])) {
        $user->update([
            'password' => bcrypt($validated['user']['password']),
        ]);
    }
    $client->update([
        'full_name' => $validated['full_name'],
        'phone' => $validated['phone'],
        'company_name' => $request->input('company_name'),
        'address' => $request->input('address'),
        'notes' => $request->input('notes'),
        'status' => $validated['status'],
    ]);
    return redirect()->route('admin.clients')->with('success', 'Account updated successfully!');
})->name('client.update.admin');

Route::get('/admin/clients/create', function () {
    Gate::authorize('create', Client::class);
    return view('client.create', [
        'status' => old('status', null)
    ]);
})->name('admin.create');

Route::post('/admin/clients', function (ClientRequest $request) {
    Gate::authorize('create', Client::class);
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

    return redirect()->route('admin.clients')->with('success', 'Account added successfully!');
})->name('client.store');

Route::delete('/admin/clients/{client}', function(Client $client){
    $user = User::findOrFail($client->user->id);
    $client->delete();
    $user->delete();
    return redirect()->route('admin.clients')->with('success', 'Account deleted successfully!');
})->name('client.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
