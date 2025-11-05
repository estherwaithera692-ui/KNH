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
        Schema::table('bio_data', function (Blueprint $table) {
            $table->string('highest_academic_certificate_file')->nullable();
            $table->string('professional_certificate_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bio_data', function (Blueprint $table) {
            $table->dropColumn(['highest_academic_certificate_file', 'professional_certificate_file']);
        });
    }
};
