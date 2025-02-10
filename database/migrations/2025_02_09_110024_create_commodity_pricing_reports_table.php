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
        Schema::create('commodity_pricing_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->nullable();
            $table->string('commodity');
            $table->string('unit');
            $table->foreignId('state_id')->constrained();
            $table->foreignId('lga_id')->constrained();
            $table->string('location');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodity_pricing_reports');
    }
};
