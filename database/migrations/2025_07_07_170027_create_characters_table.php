<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('gender');
            $table->string('class');
            $table->string('race');
            $table->string('faction');
            $table->string('realm');
            $table->string('xpac');
            $table->string('image_url')->nullable();
            $table->string('splash_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
