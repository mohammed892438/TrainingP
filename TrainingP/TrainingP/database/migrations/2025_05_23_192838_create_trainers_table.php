<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainers', function (Blueprint $table) {

            $table->unsignedBigInteger('id')->unique();

            $table->string('last_name')->nullable();


            $table->string('sex');

            $table->string('headline');

            $table->json('nationality');

            $table->json('work_sectors');

            $table->json('provided_services'); 

            $table->json('work_fields');
            

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