<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainers', function (Blueprint $table) {

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

            $table->foreignId('work_sectors_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('provided_services_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreignId('work_fields_id')
            ->constrained('work_fields')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->text('important_topics');

            $table->foreign('id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('status')->nullable();

            $table->decimal('hourly_wage', 8, 2)->nullable();

            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};