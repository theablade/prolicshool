<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
     protected $table = 'districts';
    
      public $timestamps = false;
     protected $fillable = [
        'nome',
         'province_id',

    ];
}