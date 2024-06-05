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
        Schema::create('add_businesses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_img1');
            $table->string('bus_img2');
            $table->string('bus_img3');
            $table->string('bus_img4');
            $table->string('bus_video');
            $table->string('bus_category');
            $table->string('bus_title');
            $table->string('bus_country');
            $table->string('bus_city');
            $table->text('bus_description');
            $table->string('bus_price');
            $table->dateTime('bus_datetime')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_businesses');
    }
};
