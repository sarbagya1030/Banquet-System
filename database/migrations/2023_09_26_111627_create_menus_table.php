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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('foodname')->nullable();
            $table->string('type')->nullable();
            $table->decimal('price')->nullable();
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
        Schema::dropIfExists('menus');
    }
};
