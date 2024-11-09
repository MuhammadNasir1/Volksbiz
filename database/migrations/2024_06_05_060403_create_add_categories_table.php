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
        Schema::create('add_categories', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name_en');
            $table->string('name_de');
            $table->string('status')->default(1);
            $table->dateTime('datetime')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_categories');
    }
};
