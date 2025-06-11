<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();

            $table->string('last_name');

            $table->string('sex');

            $table->string('headline');

            $table->json('nationality');

            $table->integer('years_of_experience');

            $table->json('experience_areas');


            $table->json('provided_services');

            $table->foreign('id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->decimal('hourly_wage', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};