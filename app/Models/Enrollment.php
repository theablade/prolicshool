<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
     protected $table = 'enrollment';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = [
        'enrollment_date',
        'price_subscrab',
        'type_payment',
        'number_doc',
         'status',
         'course_id',
         'student_id'
        
     ];
}