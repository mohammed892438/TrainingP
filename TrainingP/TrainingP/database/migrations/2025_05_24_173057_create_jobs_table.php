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
        Schema::create('job_ads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ads_id')
            ->references('id')
            ->on('advertisements')
            ->onDelete('cascade');

            $table->string('execution_method');

            $table->foreignId('language_id')
            ->references('id')
            ->on('languages')
            ->onDelete('cascade');

            $table->foreignId('country_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreignId('city_id')
            ->nullable()
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('training_level');

            $table->string('trainees_type');

            $table->string('training_duration');

            $table->decimal('trainer_wage');


            $table->text('payment_method');

            $table->text('evaluation_method');

            $table->string('entity_type')->nullable();

            $table->text('skills');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_ads');
    }
};
