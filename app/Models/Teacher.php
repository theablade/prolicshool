<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
   protected $table = 'teachers';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = [
        'nome',
        'email',
        'disciplina',
        'data_nascimento',
        'genero',
        'telefone',
        'endereco',
        'numerodoc ',
        'data_contratacao',
        'status',
        'salario',
        'tipodoc',
     ];
}