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
        Schema::create('purchase_of_raw_materials', function (Blueprint $table) {
            $table->string('purchase_id')->primary();
            $table->foreignId('raw_material_id')
                ->constrained('raw_materials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('unit_price');
            $table->unsignedInteger('total');
            $table->date('purchase_date');
            $table->foreignId('supplier_id')
                ->nullable()
                ->constrained('suppliers')
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
        Schema::dropIfExists('purchase_of_raw_materials');
    }
};
