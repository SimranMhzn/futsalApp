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
        Schema::table('futsals', function (Blueprint $table) {
            // ✅ Add a new email column (nullable for safety)
            $table->string('email')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('futsals', function (Blueprint $table) {
            // ✅ Remove the email column if rolled back
            $table->dropColumn('email');
        });
    }
};
