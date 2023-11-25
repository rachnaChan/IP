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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->float('transcript')->nullable();
            $table->float('language')->nullable();
            $table->float('motivation_letter')->nullable();
            $table->float('recommendation_letter')->nullable();
            $table->float('cv')->nullable();
            $table->float('related_experience')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('head_of_program_id');
            $table->unsignedBigInteger('applicant_id');

            $table->foreign('head_of_program_id')->references('id')->on('users');
            $table->foreign('applicant_id')->references('id')->on('applicant_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
