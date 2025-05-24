<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->unsignedBigInteger('id');

            $table->string('last_name');

            $table->string('sex');

            $table->unsignedBigInteger('nationality_id');

            $table->foreign('nationality_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('work_fields_id')
            ->constrained('work_fields')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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