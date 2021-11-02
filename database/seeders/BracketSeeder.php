<?php

namespace Database\Seeders;

use App\Models\Bracket;
use Illuminate\Database\Seeder;

class BracketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bracket::create([
            'name' => 'Herald'
        ]);

        Bracket::create([
            'name' => 'Guardian'
        ]);

        Bracket::create([
            'name' => 'Crusader'
        ]);

        Bracket::create([
            'name' => 'Archon'
        ]);

        Bracket::create([
            'name' => 'Legend'
        ]);

        Bracket::create([
            'name' => 'Ancient'
        ]);

        Bracket::create([
            'name' => 'Divine'
        ]);
        
        Bracket::create([
            'name' => 'Immortal'
        ]);
    }
}
