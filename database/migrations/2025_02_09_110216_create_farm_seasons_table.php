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
        Schema::create('farm_seasons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->foreignId('team_id')->nullable();
            $table->foreignId('farm_id');
            $table->date( 'planted_date');
            $table->date( 'harvest_date')->nullable();
            $table->string( 'season_year');
            $table->string( 'commodity');
            $table->boolean( 'status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_seasons');
    }
};
