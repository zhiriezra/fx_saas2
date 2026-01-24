<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Fertilizer Distribution',
            'description' => 'This service handles the distribution of fertilizer to agricultural stakeholders across designated regions, including logistics, transportation, delivery, inventory management, route optimization, and real-time tracking.',
            'team_type_id' => TeamType::where('name', 'Agro Input')->first()->id,
            'active' => true,
        ]);
    }
}
