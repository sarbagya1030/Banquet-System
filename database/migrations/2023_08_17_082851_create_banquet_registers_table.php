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
        Schema::create('banquet_registers', function (Blueprint $table) {
            $table->id();
            $table->string('banquetname');
            $table->string('email')->unique();
            $table->string('location');
            $table->string('registrationNumber');
            $table->string('licenseNumber');
            $table->string('contactNumber');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banquet_registers');
    }
};
