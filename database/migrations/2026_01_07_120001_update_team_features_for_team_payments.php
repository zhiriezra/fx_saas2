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
        Schema::table('team_features', function (Blueprint $table) {
            // Add foreign key to team_payments
            $table->foreignId('team_payment_id')->nullable()->after('team_id')->constrained()->onDelete('cascade');
            
            // Drop paysstack_reference column
            if (Schema::hasColumn('team_features', 'paysstack_reference')) {
                $table->dropColumn('paysstack_reference');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_features', function (Blueprint $table) {
            // Add back paysstack_reference
            $table->string('paysstack_reference')->nullable();
            
            // Drop foreign key and column
            $table->dropForeign(['team_payment_id']);
            $table->dropColumn('team_payment_id');
        });
    }
};

