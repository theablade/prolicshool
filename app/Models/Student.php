<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = [
        'nome',
        'ntelefone',
        'genero',
        'data_nascimento',
        'provincia',
        'distrito',
        'nacionalidade',
        'tipodoc',
        'numerodoc',
        'data_emisao',
        'data_validade',
        'email',
        'img',
        'dadname',
        'mothername',
         'bairro',
         'quarterao',
         'avenida',
         'horario',
         'resprovincia',
         'redistrito'
     ];
}