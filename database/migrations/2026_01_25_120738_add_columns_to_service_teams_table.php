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
        Schema::table('service_teams', function (Blueprint $table) {
            $table->decimal('total', 15, 2)->default(0.00)->after('price');
            $table->json('evaluations')->nullable()->after('total');
            $table->json('settings')->nullable()->after('evaluations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_teams', function (Blueprint $table) {
            $table->dropColumn(['total', 'evaluations', 'settings']);
        });
    }
};
