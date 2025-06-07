<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('description');

            $table->json('training_areas');

            $table->string('client_type');

            $table->string('client_level');

            $table->string('application_method');

            $table->decimal('hourly_wage',8,2);

            $table->foreignId('work_experience_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->text('added_value');

            $table->text('notes');


            $table->foreignId('users_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};