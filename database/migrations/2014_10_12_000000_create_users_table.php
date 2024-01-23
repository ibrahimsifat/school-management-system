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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'student', 'teacher', 'parent'])->default('student');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->string('admission_number')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('course_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('caste')->nullable();
            $table->string('blood_group')->nullable();
            $table->foreignId('guardian_id')->nullable();
            $table->foreign('guardian_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('religion')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('qualification')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('note')->nullable();
            $table->string('mobile_number')->nullable();
            $table->date('admission_date')->nullable();
            $table->string('image')->nullable();
            $table->string('occupation')->nullable();;
            $table->string('address')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
