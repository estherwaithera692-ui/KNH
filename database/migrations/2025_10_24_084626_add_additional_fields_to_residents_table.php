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
        Schema::table('residents', function (Blueprint $table) {
            $table->string('resident_number')->unique()->after('id');
            $table->string('resident_area')->after('postal_code'); // e.g., university, hospital, etc.
            $table->string('role')->after('resident_area'); // e.g., Doctor, Nurse, Student
            $table->string('department')->after('role'); // e.g., Surgery, Pediatrics, etc.
            $table->text('medical_credentials')->nullable()->after('department'); // medical qualifications
            $table->date('start_date')->after('medical_credentials'); // residency start date
            $table->date('end_date')->nullable()->after('start_date'); // residency end date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['resident_number', 'resident_area', 'role', 'department', 'medical_credentials', 'start_date', 'end_date']);
        });
    }
};
