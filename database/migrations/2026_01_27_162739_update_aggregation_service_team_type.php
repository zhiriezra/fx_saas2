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
        // Update "Aggregation/Demand Sourcing" service to use 'agro-input' team type
        $agroInputTeamTypeId = \DB::table('team_types')
            ->where('slug', 'agro-input')
            ->value('id');
        
        if ($agroInputTeamTypeId) {
            \DB::table('services')
                ->where('name', 'Aggregation/Demand Sourcing')
                ->update(['team_type_id' => $agroInputTeamTypeId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to 'agro-processors' team type
        $agroProcessorsTeamTypeId = \DB::table('team_types')
            ->where('slug', 'agro-processors')
            ->value('id');
        
        if ($agroProcessorsTeamTypeId) {
            \DB::table('services')
                ->where('name', 'Aggregation/Demand Sourcing')
                ->update(['team_type_id' => $agroProcessorsTeamTypeId]);
        }
    }
};
