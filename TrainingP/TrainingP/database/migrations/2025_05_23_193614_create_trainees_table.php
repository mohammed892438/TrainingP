<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();

            $table->string('last_name');

            $table->string('sex');

            $table->json('nationality');

            $table->json('work_fields');

            $table->foreignId('education_levels_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};