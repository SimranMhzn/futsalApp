<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('futsals', function (Blueprint $table) {
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('futsals', function (Blueprint $table) {
            $table->dropColumn(['open_time', 'close_time']);
        });
    }
};
