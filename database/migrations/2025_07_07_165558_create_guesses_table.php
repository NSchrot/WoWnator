<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('guesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('daily_challenge_id')->constrained('daily_challenges')->onDelete('cascade');
            $table->enum('type', ['character', 'zone', 'quote', 'mount', 'skill']);
            $table->unsignedBigInteger('guess_id');
            $table->boolean('is_correct');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guesses');
    }
};
