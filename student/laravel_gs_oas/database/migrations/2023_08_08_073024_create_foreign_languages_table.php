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
        Schema::create('foreign_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('certificate')->nullable();
            $table->date('date_of_received')->nullable();
            $table->string('reading')->nullable();
            $table->string('writing')->nullable();
            $table->string('listening')->nullable();
            $table->string('speaking')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foreign_languages');
    }
};
