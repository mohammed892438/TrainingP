<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('the_authority');

            $table->date('start_date');

            $table->date('end_date')->nullable();

            $table->foreignId('country_id')
            ->constrained('countries')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->foreignId('users_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};