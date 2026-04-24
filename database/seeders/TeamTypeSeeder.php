<?php

namespace Database\Seeders;

use App\Models\TeamType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create team types
        TeamType::create([
            'name' => 'Extension Africa',
            'slug' => 'extension_africa',
            'description' => 'Extension Africa',
            'status' => true,
        ]);

        TeamType::create([
            'name' => 'Agro Input',
            'slug' => 'agro_input',
            'description' => 'Agro Input is a team type for Agro Input users',
            'status' => true,
        ]);

        TeamType::create([
            'name' => 'Agro Processor',
            'slug' => 'agro_processor',
            'description' => 'Agro Processors is a team type for Agro Processors users',
            'status' => true,
        ]);

        TeamType::create([
            'name' => 'Partner',
            'slug' => 'partner',
            'description' => 'Partners is a team type for Partners users',
            'status' => true,
        ]);
    }
}
