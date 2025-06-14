<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('commitments', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->foreignId('organizations_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('committed_to');
            
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('commitments');
    }
};