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
        Schema::create('physical_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('translator')->nullable();
            $table->string('cover_image')->nullable();
            $table->year('publication_year')->nullable();
            $table->string('printing_house')->nullable();
            $table->string('edition')->nullable();
            $table->string('shelf_no')->nullable();
            $table->unsignedInteger('copies');
            $table->unsignedInteger('available_copies');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_books');
    }
};
