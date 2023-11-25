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
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->string('itc_graduate_year')->nullable();
            $table->string('major')->nullable();
            $table->string('high_school_grade')->nullable();
            $table->string('high_school_year')->nullable();
            $table->string('high_school_name')->nullable();
            $table->string('high_school_province')->nullable();
            $table->string('high_school_country')->nullable();      
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_backgrounds');
    }
};
