<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Public booking reference
            $table->string('booking_code')->unique();

            // Relationships
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('event_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Ticket details
            $table->integer('number_of_tickets');
            $table->decimal('ticket_price', 8, 2);

            // Pricing breakdown
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->decimal('total_amount', 8, 2);
            $table->decimal('final_amount', 8, 2);

            // Status
            $table->enum('status', ['pending', 'confirmed', 'canceled'])
                  ->default('pending');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id']);
            $table->index(['event_id']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
