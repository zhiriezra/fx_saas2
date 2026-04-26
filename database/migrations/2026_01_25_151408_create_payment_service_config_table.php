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
        Schema::create('payment_service_config', function (Blueprint $table) {
            $table->id();
            $table->string('paysstack_reference')->unique();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->json('config');
            $table->timestamps();
            
            // Index for faster lookups
            $table->index('paysstack_reference');
            $table->index('team_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_service_config');
    }
};
