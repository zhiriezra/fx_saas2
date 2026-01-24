<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'name' => 'Agent Management',
            'value' => '29.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Order Tracking',
            'value' => '24.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Demand/Sourcing',
            'value' => '34.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Traceability Codes',
            'value' => '19.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Quality Checks',
            'value' => '27.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Payments & Wallet',
            'value' => '39.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Logistics Routing',
            'value' => '32.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Dashboards & Insights (Pro)',
            'value' => '49.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'White Label/API',
            'value' => '59.00',
            'active' => true,
        ]);

        Feature::create([
            'name' => 'Dedicated Agent Team',
            'value' => '99.00',
            'active' => true,
        ]);
    }
}
