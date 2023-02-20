<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReviewFile>
 */
class ReviewFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'review_id' => Review::query()->inRandomOrder()->first(),
            'extension' => $this->faker->randomElement(['jpg', 'jpeg', 'png']),
            'path' => 'TestPath'
        ];
    }
}
