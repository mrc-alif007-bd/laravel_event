<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100);
            $table->string('address', 150);
            $table->string('city', 100);
            $table->integer('capacity');
            $table->text('description')->nullable();

            // 1 = Active, 0 = Inactive
            $table->boolean('status')->default(true);

            $table->string('image')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
