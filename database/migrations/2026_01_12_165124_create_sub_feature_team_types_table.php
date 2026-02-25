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
        Schema::create('sub_feature_team_types', function (Blueprint $table) {
            $table->foreignId('sub_feature_id')->constrained('sub_features')->onDelete('cascade');
            $table->foreignId('team_type_id')->constrained('team_types')->onDelete('cascade');
            $table->primary(['sub_feature_id', 'team_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_feature_team_types');
    }
};
