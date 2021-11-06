<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BracketSeeder::class,
        ]);
        User::factory(50)->create();
        Team::factory(10)->create();
    }
}
