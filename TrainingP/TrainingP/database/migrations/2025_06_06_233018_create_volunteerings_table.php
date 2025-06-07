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
        Schema::create('volunteerings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('type')
            ->references('id')
            ->on('provided_services')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('mounthly_hours');

            $table->json('training_titles');

            $table->foreignId('users_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteerings');
    }
};
