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
            $table->decimal('quantity', 15, 2)->nullable()->after('value');
            $table->foreignId('quantity_unit_id')->nullable()->constrained('units')->after('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_teams', function (Blueprint $table) {
            $table->dropForeign(['quantity_unit_id']);
            $table->dropColumn(['quantity', 'quantity_unit_id']);
        });
    }
};
