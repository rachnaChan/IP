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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('schedule');
            $table->text('syllabus');
            $table->string('image')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('lecturer_id')->nullable;
            $table->date('deadline');

            $table->foreign('program_id')->references('id')->on('programs');
            $table->foreign('lecturer_id')->references('id')->on('lecturer_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
