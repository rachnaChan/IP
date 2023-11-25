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
        Schema::table('higher_educations', function (Blueprint $table) {
            $table->unsignedBigInteger('applicant_id');

            $table->foreign('applicant_id')->references('id')->on('applicant_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('higher_educations', function (Blueprint $table) {
            //
        });
    }
};
