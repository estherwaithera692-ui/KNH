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
            // Fields for RESIDENT type
            $table->string('residence_address')->nullable()->after('status');
            $table->integer('residence_duration')->nullable()->after('residence_address');

            // Fields for NON-RESIDENT type
            $table->string('visa_type')->nullable()->after('residence_duration');
            $table->date('visa_expiry')->nullable()->after('visa_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bio_data', function (Blueprint $table) {
            $table->dropColumn(['residence_address', 'residence_duration', 'visa_type', 'visa_expiry']);
        });
    }
};
