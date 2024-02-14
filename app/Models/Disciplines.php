<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplines extends Model
{
       protected $table = 'disciplines';
    
      public $timestamps = false;
     protected $fillable = [
        'nome',
        'descricao'
       
        

    ];
}