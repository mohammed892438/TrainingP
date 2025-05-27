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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 6)->nullable();
            $table->char('code',3)->nullable();
            $table->string('name', 80)->nullable();
            $table->string('symbol', 10)->nullable();
            $table->string('currency', 3)->nullable();
            $table->timestamps();

             //index
            $table->index(['currency','name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
