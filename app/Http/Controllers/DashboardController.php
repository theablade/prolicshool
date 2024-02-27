<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\MonthlyPayment;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class DashboardController extends Controller
{
    public function index()
    {

        $mytime      = Carbon::now('Africa/Maputo');
        $mes = date('m', strtotime($mytime));
        $ano = date('Y', strtotime($mytime));
        


        $monty = DB::table('monthly_payment')
         ->select(DB::raw('sum(price_enrollemnt) as total'),  DB::raw('count(id) as qtmonty'), DB::raw('Month(payment_date) as meses'))
        ->whereYear('payment_date', $ano)
        ->whereMonth('payment_date', $mes)
        ->where('payment_status', 'Pago')
          ->groupBy(DB::raw('Month(payment_date)'))
        ->orderBy('meses', 'DESC')
         ->get();

          $year = DB::table('monthly_payment')
         ->select(DB::raw('sum(price_enrollemnt) as total'),  DB::raw('count(id) as qtyears'), DB::raw('Year(payment_date) as years'))
        ->whereYear('payment_date', $ano)
        ->where('payment_status', 'Pago')
          ->groupBy(DB::raw('Year(payment_date)'))
        ->orderBy('years', 'DESC')
         ->get();
     
      
        $yearsenrollment = DB::table('monthly_payment')
        ->select(DB::raw('sum(price_enrollemnt) as total'))
        ->whereYear('payment_date', $ano)
        ->first();

          $montlyenrollment = DB::table('monthly_payment')
        ->select(DB::raw('sum(price_enrollemnt) as total'))
        ->whereYear('payment_date', $ano)
        ->whereMonth('payment_date', $mes)
        ->first();

           $yearEnrollment = DB::table('enrollment')
        ->select(DB::raw('sum(price_subscrab) as total'))
        ->whereYear('enrollment_date', $ano)
        ->first();

          $montlyEnrollment = DB::table('enrollment')
        ->select(DB::raw('sum(price_subscrab) as total'))
        ->whereYear('enrollment_date', $ano)
        ->whereMonth('enrollment_date', $mes)
        ->first();

        return view('dashboard', compact('montlyenrollment', 'yearsenrollment', 'yearEnrollment','montlyEnrollment', 'monty', 'year'));
    }

    

}