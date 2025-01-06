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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreignId('agent_id')->constrained();
            $table->string('venue');
            $table->foreignId('state_id')->constrained();
            $table->foreignId('lga_id')->constrained();
            $table->integer('number_of_participants');
            $table->integer('females')->nullable();
            $table->integer('males')->nullable();
            $table->string('participant_list')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
