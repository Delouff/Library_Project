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
        Schema::create('author__books', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books');
            $table->foreignId('author_id')->constrained('authors');
            $table->timestamps();

            $table->primary(['author_id' , 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author__books');
    }
};
