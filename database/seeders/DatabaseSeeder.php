<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Update;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;

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
        User::create([
            'username' => 'admin',
            'email' => 'admin@google.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('root'),
            'role' => 'ADMIN',
            'rating' => 0,
            'bracket_id' => 8
        ]);
        User::factory(50)->create();
        // Team::factory(10)->create();

        Update::create([
            'title' => 'Beginning of New Era',
            'thumbnail_path' => asset('media/wallpaper.jpg'),
            'patch_code' => '6.50',
            'description' => 'Release of DOTA 2'
        ]);
    }
}
