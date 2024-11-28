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
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('designation', 100)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('blood_group', 3)->nullable();
            $table->text('address')->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->text('extra_skill')->nullable();
            $table->string('volunteer_id', 50)->unique()->nullable();
            $table->date('joining_date')->nullable();
            $table->text('education')->nullable();
            $table->text('awards')->nullable();
            $table->integer('blood_donation_count')->default(0);
            $table->integer('review_points')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')
            ->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
