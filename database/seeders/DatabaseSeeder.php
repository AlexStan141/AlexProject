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

        User::factory()->create([
            'name' => 'Stan Nicolae-Alexandru',
            'email' => 'alexnstan@gmail.com',
            'role' => 'Admin'
        ]);

        User::factory(10)->create([
            'role' => 'Client'
        ]);

        $users = User::all();

        Admin::factory()->create([
            'full_name' => 'Stan Nicolae-Alexandru',
            'phone' => '+1.234.567.8901',
            'company_name' => 'Aura SRL.',
            'address' => '1718 Koelpin Forge Apt. 760 Maurineside, CA 99984-3469',
            'notes' => 'Gaudeamus igitur',
            'status' => 'Active',
            'user_id' => $users->shift()->id
        ]);

        for($i = 0; $i < 10; $i++){
            $user = $users->shift();
            Client::factory()->create([
                'user_id' => $user->id,
                'full_name' => $user->name
            ]);
        }
    }
}
