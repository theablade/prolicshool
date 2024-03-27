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
        Schema::create('monthly_payments', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('enrollment_id');
        $table->float('price_enrollemnt', 8, 2);
        $table->date('payment_date');
        $table->string('payment_status');
        $table->unsignedBigInteger('course_id');
        $table->unsignedBigInteger('student_id');
        $table->string('month');
        $table->string('type_payment');
        $table->text('payment_history')->nullable();
        $table->date('endDate');
        $table->foreign('enrollment_id')->references('id')->on('enrollments');
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
        Schema::dropIfExists('monthly_payments');
    }
};