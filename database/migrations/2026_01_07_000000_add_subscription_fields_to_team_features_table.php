<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change is_enabled from boolean to tinyInteger (0=used, 1=active, 2=processing)
        if (Schema::hasColumn('team_features', 'is_enabled')) {
            DB::statement('ALTER TABLE team_features MODIFY is_enabled TINYINT NOT NULL DEFAULT 2 COMMENT "0=used, 1=active, 2=processing"');
        }
        
        // Add subscription fields
        Schema::table('team_features', function (Blueprint $table) {
            if (!Schema::hasColumn('team_features', 'start_date')) {
                $table->date('start_date')->nullable();
            }
            if (!Schema::hasColumn('team_features', 'end_date')) {
                $table->date('end_date')->nullable();
            }
            if (!Schema::hasColumn('team_features', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('team_features', 'duration')) {
                $table->integer('duration')->nullable()->comment('Duration in months');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_features', function (Blueprint $table) {
            $columnsToDrop = [];
            
            if (Schema::hasColumn('team_features', 'start_date')) {
                $columnsToDrop[] = 'start_date';
            }
            if (Schema::hasColumn('team_features', 'end_date')) {
                $columnsToDrop[] = 'end_date';
            }
            if (Schema::hasColumn('team_features', 'price')) {
                $columnsToDrop[] = 'price';
            }
            if (Schema::hasColumn('team_features', 'duration')) {
                $columnsToDrop[] = 'duration';
            }
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
        
        // Change is_enabled back to boolean if it exists
        if (Schema::hasColumn('team_features', 'is_enabled')) {
            DB::statement('ALTER TABLE team_features MODIFY is_enabled BOOLEAN NOT NULL DEFAULT TRUE');
        }
    }
};
