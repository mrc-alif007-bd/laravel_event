<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('title', 150);
            $table->text('description')->nullable();

            // Relationships
            $table->foreignId('venue_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Event schedule
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');

            // Paid or Free
            $table->boolean('is_paid')->default(false);
            $table->decimal('price', 8, 2)->default(0);

            // Ticket control
            $table->integer('total_tickets');
            $table->integer('available_tickets');

            // Ticket sale window
            $table->timestamp('sale_start_at')->nullable();
            $table->timestamp('sale_end_at')->nullable();

            // 1 = Upcoming, 2 = Completed, 3 = Canceled
            $table->tinyInteger('status')->default(1);

            $table->string('image')->default('event_image/noimage.jpg');

            $table->timestamps();
            $table->softDeletes();

            $table->index(['venue_id']);
            $table->index(['category_id']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
