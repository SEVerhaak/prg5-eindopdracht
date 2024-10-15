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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('uploaded_by_user');
            $table->string('name');
            $table->string('artist');
            $table->integer('year');
            $table->integer('genre');
            $table->binary('image')->nullable();
            $table->string('image_url')->nullable();
            $table->tinyInteger('rating')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
