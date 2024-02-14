<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = 'courses';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = [
        'nome',
        'descricao',
        'nivel',
        'price_enrollemnt',
        'price_subscrab',
        'price_pfees',
        'code_course'
        

    ];
}