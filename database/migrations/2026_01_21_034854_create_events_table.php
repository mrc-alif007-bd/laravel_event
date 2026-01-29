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
            $table->smallIncrements('id'); // 5 digit
            $table->string('title',50);
            $table->smallInteger('venue_id');
            $table->decimal('price',8,2);
            $table->string('description',200)->nullable();
            $table->smallInteger('Category_id');
            $table->string('status',100);            
            $table->string('image',100);            
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
