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
        Schema::create('online_orders', function (Blueprint $table) {
            $table->string('online_order_id')->primary();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->date('pick_up_date');
            $table->time('pick_up_time');
            $table->time('estimation_time');
            $table->enum('status', ['pending', 'success', 'failed', 'process'])
                ->default('pending');
            $table->unsignedInteger('total');
            $table->text('message');
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
        Schema::dropIfExists('online_orders');
    }
};
