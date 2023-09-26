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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('banquetname');
            $table->string('registrationNumber');
            $table->string('location');
            $table->string('licenseNumber');
            $table->string('contactNumber');
            $table->string('capacity');
            $table->string('email');
            $table->unsignedBigInteger('fk_dates_id');
            $table->foreign('fk_dates_id')->references('id')->on('dates');
            $table->unsignedBigInteger('fk_images_id');
            $table->foreign('fk_images_id')->references('id')->on('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
