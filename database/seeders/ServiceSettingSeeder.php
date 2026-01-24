<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceSetting;
use App\Models\Service;
use App\Models\Unit;

class ServiceSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Avg Kg Per Bag',
            'value' => '50',
            'unit_id' => Unit::where('name', 'kg')->first()->id,
            'active' => true,
        ]);
        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Avg Bags Per Agent Per Month',
            'value' => '2000',
            'unit_id' => Unit::where('name', 'Bags')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Avg price Per Bag',
            'value' => '5000',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Avg Agent Commission Percent age',
            'value' => '0.05',
            'unit_id' => Unit::where('name', '%')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => ' Avg Farmer Lead Per Agent',
            'value' => '5',
            'unit_id' => Unit::where('name', 'kg')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => ' Avg Cost Per Code Generated',
            'value' => '0.003',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => ' Avg Delivery Cost Per Agent Per Month',
            'value' => '20',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => ' Avg Dashboard Access Cost Per Month',
            'value' => '400',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Sales Tracking Data Per Bag',
            'value' => '0.002',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);
        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Cost Of Training Per Agent',
            'value' => '12',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);
        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => ' Avg Subscription Per Agent Per Month',
            'value' => '40',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => 'Avg Demo Fee Per Agent Per Month',
            'value' => '10',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

        ServiceSetting::create([
            'service_id' => Service::where('name', 'Fertilizer Distribution')->first()->id,
            'name' => ' Avg Training Cost Per Farmer Per Month',
            'value' => '10',
            'unit_id' => Unit::where('name', 'USD')->first()->id,
            'active' => true,
        ]);

    }
}
