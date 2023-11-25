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
        Schema::create('higher_educations', function (Blueprint $table) {
            $table->id();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('major')->nullable();
            $table->string('degree_obtained')->nullable();
            $table->date('degree_start_date')->nullable();
            $table->date('degree_end_date')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('higher_educations');
    }
};
