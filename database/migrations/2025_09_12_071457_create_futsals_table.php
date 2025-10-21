<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('futsals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->string('link')->nullable();
            $table->integer('side_no')->nullable();
            $table->integer('ground_no')->nullable();
            $table->text('description')->nullable();
            $table->json('photo')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            // Amenities
            $table->boolean('shower_facility')->default(false);
            $table->boolean('parking_space')->default(false);
            $table->boolean('changing_room')->default(false);
            $table->boolean('restaurant')->default(false);
            $table->boolean('wifi')->default(false);
            $table->boolean('open_ground')->default(false);

            $table->timestamps();

            // Foreign key to users table (optional if you have owners)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('futsals');
    }
};
