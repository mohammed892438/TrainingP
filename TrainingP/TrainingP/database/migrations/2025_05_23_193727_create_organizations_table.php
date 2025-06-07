<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {

            $table->unsignedBigInteger('id')->unique();

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
            ->references('id')
            ->on('organization_types')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string('website');

            $table->foreignId('employee_numbers_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->year('established_year');

            $table->foreignId('annual_budgets_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->json('organization_sectors');

            $table->string('work_type')->nullable();

            $table->foreign('id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};