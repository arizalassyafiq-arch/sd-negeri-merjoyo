<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Kelas ' . fake()->unique()->numberBetween(1, 12),
        ];
    }
}
