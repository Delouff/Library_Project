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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('start');
            $table->date('limit');
            $table->date('return')->nullable();
            $table->foreignId('copy_id')->constrained('copies');
            $table->foreignId('user_id')->constrained('users');
        });

        // Un exemplaire ne peut être prêté qu'une seule fois à la fois :
        // index unique partiel, limité aux prêts en cours (return à NULL).
        DB::statement('CREATE UNIQUE INDEX loans_copy_id_active_unique ON loans (copy_id) WHERE "return" IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
