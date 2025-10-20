<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'full_name' => fake()->name,
            'phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'address'=> fake()->address(),
            'notes' => fake()->sentence(),
            'status' => fake()->randomElement(Client::$status),
        ];
    }
}
