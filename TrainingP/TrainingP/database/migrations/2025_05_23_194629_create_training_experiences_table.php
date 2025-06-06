<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('training_experiences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('title_id')
            ->constrained('provided_services')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->text('description');

            $table->foreignId('trainer_id')
            ->constrained('trainers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('country_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('authority');

            $table->string('engagement_type');

            $table->integer('trainees_number');

            $table->string('trainees_type');

            $table->integer('hours_number');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('training_experiences');
    }
};