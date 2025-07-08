<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('type');
        $table->string('race');
        $table->string('class');
        $table->text('description');
        $table->string('xpac');
        $table->string('image_url')->nullable();
        $table->timestamps();
        $table->softDeletes();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
