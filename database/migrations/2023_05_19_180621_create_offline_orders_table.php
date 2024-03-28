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
        Schema::create('offline_orders', function (Blueprint $table) {
            $table->string('offline_order_id')->primary();
            $table->string('name');
            $table->enum('status', ['success', 'process'])
                ->default('process');
            $table->unsignedInteger('total');
            $table->string('reservation_id')->nullable();
            $table->foreign('reservation_id')
                ->references('reservation_id')
                ->on('reservations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offline_orders');
    }
};
