<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('daily_challenges', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->foreignId('character_id')->constrained('characters');
            $table->foreignId('zone_id')->constrained('zones');
            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('mount_id')->constrained('mounts');
            $table->foreignId('skill_id')->constrained('skills');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_challenges');
    }
};
