<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
       protected $table = 'expenses';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = ['tipo', 'valor', 'data', 'descricao', '	transacao'];
}