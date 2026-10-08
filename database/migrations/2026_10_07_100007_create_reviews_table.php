<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('book_id')->constrained('books');
            $table->integer('note');
            $table->text('comment');
            $table->timestamps();

            $table->primary(['user_id' , 'book_id']);
        });

        // SQLite ne permet pas d'ajouter une contrainte CHECK à une table existante :
        // la note (1 à 5 étoiles) est donc contrôlée par deux triggers, à l'insertion et à la modification.
        DB::unprepared("
            CREATE TRIGGER reviews_note_check_insert BEFORE INSERT ON reviews
            WHEN NEW.note NOT BETWEEN 1 AND 5
            BEGIN
                SELECT RAISE(ABORT, 'La note doit être comprise entre 1 et 5');
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER reviews_note_check_update BEFORE UPDATE OF note ON reviews
            WHEN NEW.note NOT BETWEEN 1 AND 5
            BEGIN
                SELECT RAISE(ABORT, 'La note doit être comprise entre 1 et 5');
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
