<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'banner' => 'uploads/123456789.jpg',
            'phone' => fake()->phoneNumber,
            'email' => fake()->email,
            'address' => fake()->address,
            'description' => fake()->paragraph(),
            'facebook' => fake()->url,
            'twitter' => fake()->url,
            'instagram' => fake()->url
        ];
    }
}
