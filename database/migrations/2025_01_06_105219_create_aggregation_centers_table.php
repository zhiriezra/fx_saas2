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
        Schema::create('aggregation_centers', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('team_id')->nullable()->constrained();
            $table->foreignId('state_id')->constrained();
            $table->foreignId('lga_id')->constrained();
            $table->string('name');
            $table->string('address');
            $table->string('contact_person');
            $table->string('contact_person_phone');
            $table->string('contact_person_email');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aggregation_centers');
    }
};
