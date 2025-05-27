<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->unsignedBigInteger('id');

            $table->string('last_name');

            $table->string('sex');

            $table->string('headline');

            $table->unsignedBigInteger('nationality_id');

            $table->foreign('nationality_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('years_of_experience');

            $table->foreignId('experience_areas_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreignId('provided_services_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

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