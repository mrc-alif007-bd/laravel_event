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
        Schema::create('bookings', function (Blueprint $table) {
            $table->smallIncrements('id');

            // Foreign keys
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('event_id');

            $table->tinyInteger('number_of_ticket');
            $table->decimal('total_amount', 8, 2);

            $table->string('status', 100);

            $table->timestamps();

            // Optional: add foreign key constraints
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
