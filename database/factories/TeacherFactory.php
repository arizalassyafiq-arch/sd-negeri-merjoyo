<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->guru(), // Otomatis buat user role guru
            'subject' => fake()->randomElement([
                'Matematika',
                'Bahasa Indonesia',
                'IPA',
                'IPS',
                'Bahasa Inggris',
                'PJOK',
                'Seni Budaya',
                'PAI'
            ]),
        ];
    }
}
