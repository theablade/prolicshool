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
         Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->text('descricao');
        $table->enum('nivel', ['Básico', 'Intermediário', 'Avançado']);
        $table->float('price_enrollemnt', 12, 2);
        $table->float('price_subscrab', 12, 2);
        $table->float('price_pfees', 12, 2);
        $table->string('code_course')->unique();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};