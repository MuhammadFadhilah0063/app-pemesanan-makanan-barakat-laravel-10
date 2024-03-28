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
        Schema::create('reservation_items', function (Blueprint $table) {
            $table->bigIncrements('reservation_item_id')->unsigned();
            $table->foreignId('table_id')
                ->constrained('tables')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('reservation_id');
            $table->foreign('reservation_id')
                ->references('reservation_id')
                ->on('reservations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**8
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_items');
    }
};
