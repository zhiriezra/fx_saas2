<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            
            // Ensure a service-unit combination is unique
            $table->unique(['service_id', 'unit_id']);
        });

        // Migrate existing data from quantity_unit_id to the pivot table
        $services = \DB::table('services')
            ->whereNotNull('quantity_unit_id')
            ->get();

        foreach ($services as $service) {
            \DB::table('service_units')->insert([
                'service_id' => $service->id,
                'unit_id' => $service->quantity_unit_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_units');
    }
};
