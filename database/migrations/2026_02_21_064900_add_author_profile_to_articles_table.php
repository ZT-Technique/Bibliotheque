<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('author_image', 255)->nullable()->after('authors');
            $table->string('author_level', 255)->nullable()->after('author_image'); // Niveau d'études
            $table->string('author_country', 100)->nullable()->after('author_level'); // Pays
            $table->date('publication_date')->nullable()->after('year'); // Date complète jour/mois/an
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['author_image', 'author_level', 'author_country', 'publication_date']);
        });
    }
};
