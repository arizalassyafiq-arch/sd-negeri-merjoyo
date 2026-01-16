<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        $gender = fake()->randomElement(['L', 'P']);

        return [
            'name' => fake()->name($gender === 'L' ? 'male' : 'female'),
            'nisn' => fake()->unique()->numerify('##########'),
            'nik' => fake()->unique()->numerify('32##############'),
            'gender' => $gender,

            'classroom_id' => Classroom::inRandomOrder()->first()?->id ?? Classroom::factory(),

            'birth_place' => fake()->city(),
            'birth_date' => fake()->date('Y-m-d', '-7 years'),
            'address' => fake()->address(),
            'father_name' => fake()->name('male'),
            'mother_name' => fake()->name('female'),

            'guardian_id' => null,

            'status' => fake()->randomElement(['active', 'active', 'active', 'pindah']), // Perbanyak active
        ];
    }
}
