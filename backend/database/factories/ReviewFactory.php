<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ReviewFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->text(150),
            'user_id' => User::query()->inRandomOrder()->first(),
            'item_id' => Item::query()->inRandomOrder()->first(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function () {
            ReviewFile::factory(3)->create();
        });
    }
}
