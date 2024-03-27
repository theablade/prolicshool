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
    Schema::create('enrollments', function (Blueprint $table) {
    $table->id();
    $table->date('enrollment_date');
    $table->float('price_subscrab', 12, 2);
    $table->string('type_payment');
    $table->string('number_doc');
    $table->string('status');
    $table->unsignedBigInteger('course_id');
    $table->unsignedBigInteger('student_id');
    $table->foreign('course_id')->references('id')->on('courses');
    $table->foreign('student_id')->references('id')->on('students');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};