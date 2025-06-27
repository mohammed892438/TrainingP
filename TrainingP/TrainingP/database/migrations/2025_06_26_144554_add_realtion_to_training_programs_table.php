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
        Schema::table('training_programs', function (Blueprint $table) {
            $table->foreignId('program_type_id')
            ->references('id')
            ->on('program_types')
            ->onDelete('cascade');

            $table->foreignId('language_type_id')
            ->references('id')
            ->on('languages')
            ->onDelete('cascade');

            $table->foreignId('training_classification_id')
            ->references('id')
            ->on('training_classifications')
            ->onDelete('cascade');

            $table->foreignId('training_level_id')
            ->references('id')
            ->on('training_levels')
            ->onDelete('cascade');

            $table->foreignId('program_presentation_method_id')
            ->references('id')
            ->on('program_presentation_methods')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_programs', function (Blueprint $table) {
            //
        });
    }
};
