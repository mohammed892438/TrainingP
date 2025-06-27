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
        Schema::create('scheduling_training_sessions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('training_program_id')
            ->references('id')
            ->on('training_programs')
            ->onDelete('cascade');
        
            $table->date('session_date');
            $table->unsignedInteger('duration_minutes'); 
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduling_training_sessions');
    }
};
