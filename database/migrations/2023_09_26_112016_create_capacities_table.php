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
        Schema::create('capacities', function (Blueprint $table) {
            $table->id();
            $table->integer('banquet_capacity');
            $table->integer('twowheeler');
            $table->integer('fourwheeler');
            $table->unsignedBigInteger('fk_banquet_id');
            $table->foreign('fk_banquet_id')->references('id')->on('banquet_registers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacities');
    }
};
