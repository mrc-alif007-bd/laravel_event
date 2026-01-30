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
        Schema::create('events', function (Blueprint $table) {
            $table->smallIncrements('id'); // 5 digit id
            $table->string('title', 50);
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->string('description', 200)->nullable();
            $table->tinyInteger('category_id')->default(0); // 0 = Not Paid, 1 = Paid
            $table->tinyInteger('status')->default(1); // 1 = Up Coming, 2 = Completed, 3 = Canceled
            $table->string('image', 100)->nullable()->default('event_image/noimage.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
