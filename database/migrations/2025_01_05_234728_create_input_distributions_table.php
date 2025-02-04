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
        Schema::create('input_distributions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('team_id')->constrained();
            $table->foreignId('state_id')->constrained();
            $table->foreignId('lga_id')->constrained();
            $table->foreignId('farmer_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->string('warehouse_name');
            $table->double('amount_due', 8,2);
            $table->date('month_reported');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_distributions');
    }
};
