<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedSmallInteger('event_id');

            $table->tinyInteger('number_of_ticket');
            $table->decimal('total_amount', 8, 2)->default(0);

            $table->string('status', 100)->default('pending'); // booking status

            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('phone', 50)->nullable();

            // Payment info
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_status', 50)->default('pending');
            $table->string('transaction_id', 255)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
