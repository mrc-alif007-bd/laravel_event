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
        Schema::create('venues', function (Blueprint $table) {
            $table->smallIncrements('id'); // 5 digit
            $table->string('name',50);
            $table->string('address',50);
            $table->string('city',50);
            $table->smallInteger('capacity');
            $table->string('description',200);
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
        Schema::dropIfExists('venues');
    }
};
