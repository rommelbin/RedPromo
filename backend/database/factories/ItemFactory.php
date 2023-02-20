<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\FavoriteItem;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'category_id' => Category::query()->inRandomOrder()->first()
        ];
    }

    public function configure(): ItemFactory
    {
        return $this->afterCreating(function (Item $item) {
            FavoriteItem::factory(1)->set(
                'item_id',
                $item->getAttribute('id')
            )->create();
        });
    }
}
