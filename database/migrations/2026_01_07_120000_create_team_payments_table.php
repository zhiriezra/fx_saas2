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
        Schema::create('team_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->string('paysstack_reference')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('NGN');
            $table->string('payment_status')->default('pending'); // pending, success, failed, cancelled
            $table->string('billing_cycle')->nullable(); // monthly, annual
            $table->integer('duration')->nullable()->comment('Duration in months');
            $table->text('paystack_response')->nullable()->comment('JSON response from Paystack');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            $table->index(['team_id', 'payment_status']);
            $table->index('paysstack_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_payments');
    }
};

