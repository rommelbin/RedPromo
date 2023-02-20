<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class RandomDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if ($this->isAlreadyCreated())
            return;

        $this->create();
    }


    private function isAlreadyCreated(): bool
    {

        $isSomethingCreated = false;
        if (User::query()->count() > 0)
            $isSomethingCreated = true;
        if (Category::query()->count() > 0)
            $isSomethingCreated = true;
        if (Item::query()->count() > 0)
            $isSomethingCreated = true;
        if (Review::query()->count() > 0)
            $isSomethingCreated = true;

        return $isSomethingCreated;
    }

    private function create()
    {
        User::factory(5)->create();
        Category::factory(12)->create();
        Item::factory(10)->create();
        Review::factory(5)->create();
    }
}
