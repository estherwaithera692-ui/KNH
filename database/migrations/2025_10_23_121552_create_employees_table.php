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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('national_id')->unique();
            $table->string('contact_number')->unique();
            $table->string('email')->unique();
            $table->text('address');
            $table->string('job_title');
            $table->string('department');
            $table->string('qualification');
            $table->integer('years_of_experience');
            $table->date('date_joined');
            $table->string('license_number')->unique();
            $table->date('license_expiry_date');
            $table->string('certificate_path')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship');
            $table->string('emergency_contact_phone');
            $table->enum('role', ['Doctor', 'Nurse', 'Pharmacist', 'Lab Tech', 'Admin', 'Other']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
