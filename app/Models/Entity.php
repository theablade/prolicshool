<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entity';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = [
        'nome',
        'telefone',
        'endereco',
        'nuit',
        'email'
        

    ];
}