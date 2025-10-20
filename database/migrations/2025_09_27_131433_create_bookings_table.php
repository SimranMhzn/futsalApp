<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('futsal_id')->constrained('futsals')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // player
            $table->date('date');
            $table->string('time');
            $table->enum('status', ['booked', 'cancelled', 'completed'])->default('booked');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
