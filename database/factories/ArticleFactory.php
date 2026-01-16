<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'content' => fake()->paragraphs(3, true),
            'image_path' => null,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),

            'author_id' => User::factory()->state(['role' => 'admin']),
        ];
    }
}
