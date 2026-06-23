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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 500);
            $table->string('authors', 500);
            $table->integer('year')->nullable();
            $table->foreignId('theme_id')->constrained()->onDelete('restrict');
            $table->text('abstract')->nullable();
            $table->string('keywords', 500)->nullable();
            $table->string('pdf_path', 255);
            $table->string('cover_image', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
