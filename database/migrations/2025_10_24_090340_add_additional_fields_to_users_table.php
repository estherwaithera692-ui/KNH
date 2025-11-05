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
            $table->dropColumn('name');
            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone_number')->unique()->nullable()->after('email');
            $table->enum('status', ['Active', 'Inactive', 'Deactivated'])->default('Active')->after('password');
            $table->unsignedBigInteger('usertype_id')->nullable()->after('status');
            $table->foreign('usertype_id')->references('id')->on('usertypes');
            $table->unsignedBigInteger('nationality_id')->nullable()->after('usertype_id');
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->enum('id_type', ['Passport', 'ID', 'Birth Certificate'])->nullable()->after('nationality_id');
            $table->string('id_number')->unique()->nullable()->after('id_type');
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable()->after('id_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['usertype_id']);
            $table->dropForeign(['nationality_id']);
            $table->dropColumn(['first_name', 'last_name', 'phone_number', 'status', 'usertype_id', 'nationality_id', 'id_type', 'id_number', 'gender']);
            $table->string('name')->after('id');
        });
    }
};
