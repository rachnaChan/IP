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
        Schema::create('applicant_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();  
            $table->string('applicant_status');
            $table->float('applicant_score')->nullable();
            $table->unsignedBigInteger('formal_personal_info_id')->nullable();
            $table->unsignedBigInteger('current_contact_info_id')->nullable();
            $table->unsignedBigInteger('secondary_contact_info_id')->nullable();
            $table->unsignedBigInteger('educational_background_id')->nullable();
            $table->unsignedBigInteger('program_id');
            $table->text('declaration')->nullable();

            $table->foreign('formal_personal_info_id')->references('id')->on('formal_personal_infos');
            $table->foreign('current_contact_info_id')->references('id')->on('current_contact_infos');
            $table->foreign('secondary_contact_info_id')->references('id')->on('secondary_contact_infos');
            $table->foreign('educational_background_id')->references('id')->on('educational_backgrounds');
            $table->foreign('program_id')->references('id')->on('programs');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_details');
    }
};
