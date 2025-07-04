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
        Schema::create('training_titles', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('job_ads_id')
            ->nullable()
            ->references('id')
            ->on('job_ads')
            ->onDelete('cascade');

            $table->foreignId('tender_id')
            ->nullable()
            ->references('id')
            ->on('tender')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_titles');
    }
};
