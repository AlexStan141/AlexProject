<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create([
            'role' => 'Client'
        ]);

        User::factory()->create([
            'name' => 'Alex Stan',
            'email' => 'alexnstan@gmail.com',
            'role' => 'Admin'
        ]);

        $users = User::all();

        Admin::factory()->create([
            'user_id' => $users->pop()->id
        ]);

        for($i = 0; $i < 10; $i++){
            Client::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }
    }
}
