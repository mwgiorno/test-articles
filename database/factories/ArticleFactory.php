<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = fake()->imageUrl(1920, 1080, 'landscapes', true, null, false, 'jpg');

        return [
            'author_id' => User::factory(),
            'headline' => fake()->sentence(),
            'thumbnail_path' => $image,
            'thumbnail_url' => $image,
            'slug' => fake()->slug(),
            'body' => fake()->text()
        ];
    }

    /**
     * Indicate that the article is published.
     */
    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'published' => true,
            ];
        });
    }
}
