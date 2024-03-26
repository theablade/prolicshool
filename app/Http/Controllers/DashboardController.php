<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\MonthlyPayment;
use App\Models\Enrollment;
use App\Models\Expenses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $mytime      = Carbon::now('Africa/Maputo');
        $mes = date('m', strtotime($mytime));
        $ano = date('Y', strtotime($mytime));
        

        $var = $request->searchresult;
    

                $expenses = Expenses::where("tipo", "LIKE", "%" . $var . "%")
                    ->orWhere("transacao", "LIKE", "%" . $var . "%")
                    ->orWhere("data", "LIKE", "%" . $var . "%")
                    ->orderBy('data', 'desc')
                    ->paginate(2);


            $totalExpenses = DB::table('expenses')
            ->select(DB::raw('sum(valor) as total'))
            ->whereYear('data', $ano)
            ->first();
          
         
           
   

        $monty = DB::table('monthly_payment')
         ->select(DB::raw('sum(price_enrollemnt) as total'),  DB::raw('count(id) as qtmonty'), DB::raw('Month(payment_date) as meses'))
         ->whereYear('payment_date', $ano)
        ->where('payment_status', 'Pago')
          ->groupBy(DB::raw('Month(payment_date)'))
        ->orderBy('meses', 'ASC')
        ->get();
        
           $Totalmonty = DB::table('monthly_payment')
            ->select(DB::raw('sum(price_enrollemnt) as total'))
            ->whereYear('payment_date', $ano)
            ->where('payment_status', 'Pago')
            ->first();

            
  
     
        
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

        $totalAmount = $Totalmonty->total + $montlyEnrollment->total + $yearEnrollment->total;
        $totalExpenses = $totalExpenses->total;
       
        if($totalExpenses !=0){
          $totalPerda = $totalAmount- $totalExpenses;
        }else if($totalExpenses == 0){
          $totalPerda = 0;
        }

    
        return view('dashboard', compact('montlyenrollment', 'yearsenrollment', 'yearEnrollment','montlyEnrollment', 'monty', 'monty2', 'year', 'year2','expenses', 'totalAmount', 'totalPerda'));
    }

    

}