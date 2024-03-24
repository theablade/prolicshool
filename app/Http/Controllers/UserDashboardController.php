<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\MonthlyPayment;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class UserDashboardController extends Controller
{
    public function index()
    {

     $user = auth()->user();
      if ($user->role === 'admin') {
        return view('dashboard');
    }
        $mytime      = Carbon::now('Africa/Maputo');
        $mes = date('m', strtotime($mytime));
        $ano = date('Y', strtotime($mytime));
        

   
      

 $totalMont = DB::table('enrollment')
    ->select(DB::raw('COUNT(id) as qtmonty'), DB::raw('MONTH(enrollment_date) as mes'))
    ->whereYear('enrollment_date', $ano)
    ->groupBy(DB::raw('MONTH(enrollment_date)'))
    ->get();

$totalMatriculasAnuais = DB::table('enrollment')
    ->select(DB::raw('COUNT(id) as totalMatriculas'))
    ->whereYear('enrollment_date', $ano)
    ->first();


     $totalMonthy = DB::table('monthly_payment')
    ->select(DB::raw('COUNT(id) as mensalidades'), DB::raw('MONTH(payment_date) as mes'))
    ->whereYear('payment_date', $ano)
    ->groupBy(DB::raw('MONTH(payment_date)'))
    ->get();

    $totalMensalidadesAnuais = DB::table('monthly_payment')
    ->select(DB::raw('COUNT(id) as totalMensalidades'))
    ->whereYear('payment_date', $ano)
    ->first();

    $totalenrollment = DB::table('monthly_payment')
    ->select(DB::raw('sum(price_enrollemnt) as total'))
    ->whereYear('payment_date', $ano)
    ->first();

        $monty = DB::table('monthly_payment')
         ->select(DB::raw('sum(price_enrollemnt) as total'),  DB::raw('count(id) as qtmonty'), DB::raw('Month(payment_date) as meses'))
         ->whereYear('payment_date', $ano)
        ->where('payment_status', 'Pago')
          ->groupBy(DB::raw('Month(payment_date)'))
        ->orderBy('meses', 'ASC')
         ->get();


          $year = DB::table('monthly_payment')
         ->select(DB::raw('sum(price_enrollemnt) as total'),  DB::raw('count(id) as qtyears'), DB::raw('Year(payment_date) as years'))
        ->where('payment_status', 'Pago')
          ->groupBy(DB::raw('Year(payment_date)'))
        ->orderBy('years', 'DESC')
         ->get();
     
          $year2 = DB::table('enrollment')
         ->select(DB::raw('sum(price_subscrab) as total'),  DB::raw('count(id) as qtyears'), DB::raw('Year(enrollment_date) as years'))
        ->whereYear('enrollment_date', $ano)
        ->where('status', 'Activo')
          ->groupBy(DB::raw('Year(enrollment_date)'))
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


        $monty2 = DB::table('enrollment')
         ->select(DB::raw('sum(price_subscrab) as total'),  DB::raw('count(id) as qtmontyEnroll'), DB::raw('Month(enrollment_date) as mesesenroll'))
        ->where('status', 'Activo')
          ->groupBy(DB::raw('Month(enrollment_date)'))
        ->orderBy('mesesenroll', 'ASC')
         ->get();

           $yearEnrollment = DB::table('enrollment')
        ->select(DB::raw('sum(price_subscrab) as total'))
        ->whereYear('enrollment_date', $ano)
        ->first();

          $montlyEnrollment = DB::table('enrollment')
        ->select(DB::raw('sum(price_subscrab) as total'))
        ->whereYear('enrollment_date', $ano)
        ->whereMonth('enrollment_date', $mes)
        ->first();

        return view('Userdashboard', compact('montlyenrollment', 'yearsenrollment', 'yearEnrollment','montlyEnrollment', 'monty', 'monty2', 'year', 'year2', 'totalMont', 'totalMatriculasAnuais', 'totalMonthy', 'totalMensalidadesAnuais'));
    }

    

}