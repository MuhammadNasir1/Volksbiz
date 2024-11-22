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
            $table->bigInteger('user_id');
            $table->string('images')->nullable();
            $table->string('video')->nullable();
            $table->string('category');
            $table->string('title');
            $table->string('title_de');
            $table->string('country');
            $table->string('city');
            $table->text('description');
            $table->text('description_de');
            $table->string('price');
            $table->string('status')->default(0);
            $table->timestamps();
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
