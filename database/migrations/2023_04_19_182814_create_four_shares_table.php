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
        Schema::create('four_shares', function (Blueprint $table) {
            $table->id();
            $table->string('link', 255);
            $table->string('name', 255);
            $table->string('size', 255);
            $table->integer('access_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('four_shares');
    }
};
