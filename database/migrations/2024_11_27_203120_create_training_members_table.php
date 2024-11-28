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
        Schema::create('training_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_id');
            $table->unsignedBigInteger('volunteer_id');
            $table->string('designation');
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('volunteer_id')->references('id')
            ->on('volunteers')->onDelete('cascade');

            $table->foreign('training_id')->references('id')
            ->on('trainings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_members');
    }
};
