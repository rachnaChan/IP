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
        Schema::create('alumni_details', function (Blueprint $table) {
            $table->id();
            $table->date('graduation_date');
            $table->string('job_title');
            $table->string('company');
            $table->string('salary_range');

            $table->unsignedBigInteger('program_id');

            $table->foreign('program_id')->references('id')->on('programs');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_details');
    }
};
