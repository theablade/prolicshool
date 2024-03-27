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
      Schema::create('teachers', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->string('ntelefone');
    $table->string('genero');
    $table->unsignedBigInteger('course_id');
    $table->date('data_nascimento');
    $table->unsignedBigInteger('provincia');
    $table->unsignedBigInteger('distrito');
    $table->string('nacionalidade');
    $table->string('tipodoc');
    $table->string('numerodoc');
    $table->date('data_emisao');
    $table->date('data_validade');
    $table->string('email')->unique();
    $table->string('img')->nullable();
    $table->string('bairro');
    $table->string('quarterao');
    $table->string('avenida');
    $table->string('horario');
    $table->unsignedBigInteger('resprovincia');
    $table->unsignedBigInteger('redistrito');
    $table->date('data_contratacao');
    $table->string('numero_casa');
    $table->string('formacao');
    $table->foreign('course_id')->references('id')->on('courses');
    $table->foreign('provincia')->references('id')->on('provinces');
    $table->foreign('distrito')->references('id')->on('districts');
    $table->foreign('resprovincia')->references('id')->on('provinces');
    $table->foreign('redistrito')->references('id')->on('districts');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};