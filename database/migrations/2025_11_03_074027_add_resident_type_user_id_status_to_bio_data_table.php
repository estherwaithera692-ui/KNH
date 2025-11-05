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
            $table->enum('resident_type', ['NON-RESIDENT', 'RESIDENT'])->default('NON-RESIDENT')->after('p_name');
            $table->unsignedBigInteger('user_id')->nullable()->after('resident_type');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bio_data', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['resident_type', 'user_id', 'status']);
        });
    }
};
