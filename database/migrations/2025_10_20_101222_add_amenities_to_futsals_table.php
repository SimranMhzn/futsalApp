<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('futsals', function (Blueprint $table) {
            $table->boolean('shower_facility')->default(false);
            $table->boolean('parking_space')->default(false);
            $table->boolean('changing_room')->default(false);
            $table->boolean('restaurant')->default(false);
            $table->boolean('wifi')->default(false);
            $table->boolean('open_ground')->default(false);
        });
    }

    public function down()
    {
        Schema::table('futsals', function (Blueprint $table) {
            $table->dropColumn([
                'shower_facility',
                'parking_space',
                'changing_room',
                'restaurant',
                'wifi',
                'open_ground',
            ]);
        });
    }

};
