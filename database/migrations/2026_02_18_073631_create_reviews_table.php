<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('event_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Rating 1–5
            $table->tinyInteger('rating');
            $table->text('comment')->nullable();

            $table->timestamps();

            $table->index(['user_id']);
            $table->index(['event_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
