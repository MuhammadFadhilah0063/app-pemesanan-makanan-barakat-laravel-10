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
        Schema::create('payments', function (Blueprint $table) {
            $table->string('payment_id')->primary();
            $table->string('online_order_id');
            $table->foreign('online_order_id')
                ->references('online_order_id')
                ->on('online_orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('payment_method');
            $table->enum('payment_status', ['pending', 'expired', 'success', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
