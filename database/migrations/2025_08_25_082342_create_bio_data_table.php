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
        Schema::create('bio_data', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('identification');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('gender');
            $table->unsignedBigInteger('nationality_id'); // Foreign key to nationalities table
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->string('phoneNumber');
            $table->string('highest_academic_certificate');
            $table->string('professional_certificate');
            $table->string('C_name');
            $table->string('C_no');
            $table->string('p_No_cert');
            $table->string('p_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bio_data');
    }
};
