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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_img1')->nullable();
            $table->string('bus_img2')->nullable();
            $table->string('bus_img3')->nullable();
            $table->string('bus_img4')->nullable();
            $table->string('bus_images')->nullable();
            $table->string('bus_video')->nullable();
            $table->string('bus_category');
            $table->string('bus_title');
            $table->string('bus_country');
            $table->string('bus_city');
            $table->text('bus_description');
            $table->string('bus_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
