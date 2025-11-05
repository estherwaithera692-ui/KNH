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
            $table->string('passport_no')->nullable()->after('status');
            $table->string('visa_no')->nullable()->after('passport_no');
            $table->string('id_front')->nullable()->after('visa_no');
            $table->string('id_back')->nullable()->after('id_front');
            $table->string('visa_upload')->nullable()->after('id_back');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bio_data', function (Blueprint $table) {
            $table->dropColumn(['passport_no', 'visa_no', 'id_front', 'id_back', 'visa_upload']);
        });
    }
};
