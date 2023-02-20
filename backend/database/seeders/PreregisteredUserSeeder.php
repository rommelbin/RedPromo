<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreregisteredUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::query()->where('email', '=', 'admin@email.com')->exists())
            return;

        $user = new User([
            'name' => 'admin',
            'password' => 'adminPass',
            'email' => 'admin@email.com'
        ]);
        $user->save();

    }
}
