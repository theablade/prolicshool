<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model
{
    protected $table = 'monthly_payment';
     protected $primaryKey = 'id';
      public $timestamps = false;
     protected $fillable = [
        'enrollment_id',
        'price_enrollemnt',
        'payment_date',
        'payment_method',
         'payment_status',
         'course_id',
         'student_id'
        
     ];
}