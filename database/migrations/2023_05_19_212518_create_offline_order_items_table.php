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
        Schema::create('offline_order_items', function (Blueprint $table) {
            $table->id('offline_order_items_id');
            $table->string('offline_order_id');
            $table->foreign('offline_order_id')
                ->references('offline_order_id')
                ->on('offline_orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('food_id')
                ->constrained('food')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offline_order_items');
    }
};
