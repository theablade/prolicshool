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
        'ntelefone',
        'genero',
          'course_id',
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
         'bairro',
         'quarterao',
         'avenida',
         'horario',
         'resprovincia',
         'redistrito',
         'data_contratacao',
         'numero_casa',
         'formacao'

    
      
     ];
}