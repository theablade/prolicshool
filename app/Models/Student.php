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
        'endereco',
        'ntelefone',
        'genero',
        'data_nascimento',
        'provincia',
        'distrito',
        'nacionalidade',
        'tipodoc',
        'numerodoc',
        'data_emissao',
        'data_validade',
        'email',
        'img',
     ];
}