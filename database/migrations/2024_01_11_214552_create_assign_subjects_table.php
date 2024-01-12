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
        Schema::create('assign_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->foreignId('created_by');
            $table->foreignId('course_id')->nullable();
            $table->foreignId('subject_id')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreign('created_by')->on('users')->references('id');
            $table->foreign('updated_by')->on('users')->references('id');
            $table->foreign('course_id')->on('courses')->references('id')->onDelete('cascade');
            $table->foreign('subject_id')->on('subjects')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_subjects');
    }
};
