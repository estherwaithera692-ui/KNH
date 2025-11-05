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
        Schema::table('users', function (Blueprint $table) {
            $table->date('dob')->nullable()->after('gender');
            $table->string('country')->nullable()->after('phone_number');
            $table->text('address')->nullable()->after('country');
            $table->string('city')->nullable()->after('address');
            $table->string('emergency_name')->nullable()->after('city');
            $table->string('emergency_phone')->nullable()->after('emergency_name');
            $table->string('relation')->nullable()->after('emergency_phone');
            $table->string('security_question')->nullable()->after('relation');
            $table->string('security_answer')->nullable()->after('security_question');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dob', 'country', 'address', 'city', 'emergency_name', 'emergency_phone', 'relation', 'security_question', 'security_answer']);
        });
    }
};
