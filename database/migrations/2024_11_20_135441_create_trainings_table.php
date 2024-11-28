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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('training_event_name');
            $table->string('training_event_type');
            $table->string('training_event_duration');
            $table->string('training_event_location');
            $table->integer('training_event_total_members');
            $table->text('training_event_description')->nullable();
            $table->string('training_event_banner_img')->nullable();
            $table->string('training_event_schedule')->nullable();
            $table->text('note')->nullable();
            $table->decimal('budget_amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
