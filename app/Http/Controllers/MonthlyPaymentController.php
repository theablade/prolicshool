<?php

namespace App\Http\Controllers;
use App\Models\MonthlyPayment;
use App\Models\Student;
use App\Models\Courses;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonthlyPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $var = $request->searchresult;
    
   
    $monthlypayment = DB::table('students as s')
        ->join('enrollment as e', 's.id', '=', 'e.student_id')
    ->join('courses as c', 'e.course_id', '=', 'c.id')
        ->select('s.id','s.nome as student', 'c.nome as course')
           ->where('s.nome', 'LIKE', '%'.$var.'%')
            ->orWhere('c.nome', 'LIKE', '%'.$var.'%')
        ->paginate(10);  

    

    
    if ($monthlypayment->isEmpty()) {
     
        return view("monthlypayment.index", [
            'monthlypayments' => $monthlypayment,
            'searchresult' => $var,
            'noResults' => true, 
        ]);
    } else {
       
        return view("monthlypayment.index", [
            'monthlypayments' => $monthlypayment,
            'searchresult' => $var,
            'noResults' => false, 
        ]);
    }
}


    public function create()
    {

        $startDate = Carbon::now()->addDays(25)->startOfMonth();
        $endDate = Carbon::now()->addMonths(1)->addDays(5)->endOfMonth();
         $students = Student::all();
        $courses = Courses::all();
        $monthlypayment = MonthlyPayment::all();
         return view("monthlypayment.create", compact('students', 'courses', 'monthlypayment', 'endDate'));
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

          $monthlypayment = new MonthlyPayment;
        $monthlypayment->fill($request->all());
        $monthlypayment->save();
        return redirect()->route("monthlypayment.index")
                         ->with("success","Matricula salva com sucesso");
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $student = DB::table('monthly_payment as m')
        ->join('students as s', 'm.student_id', '=', 's.id')
        ->join('courses as c', 'm.course_id', '=', 'c.id')
        ->select('s.id','s.nome as student' , 's.ntelefone', 'c.nome as course', 'c.id as idcourse')
        ->where('s.id', '=', $id)
        ->first();

    
        
        $monthys = DB:: table('monthly_payment')
        ->where('student_id', '=', $id)
       
        ->get();

        return view('monthlypayment.show', compact('student', 'monthys'));
        
        
    
         
    
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        
         $monthlypayment = MonthlyPayment::findOrFail($id);

         $course_price = DB::table('courses')
         ->select('price_enrollemnt as price')
         ->where('id', '=', $monthlypayment->course_id)
         ->first();


         $monthlypayment -> price_enrollemnt = $course_price->price;
           $monthlypayment ->payment_status = 'Pago';
         $monthlypayment ->payment_date = Carbon::now();
         setlocale(LC_TIME, 'pt_BR');
           $monthName = utf8_encode(Carbon::parse($monthlypayment->endDate)->formatLocalized('%B'));

       $monthlypayment->update();
        return redirect()->back()->with('msg', 'A mensalidade do mês de '. $monthName. ' Foi paga');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $monthlypayment = MonthlyPayment::findOrFail($id);
         $monthlypayment -> price_enrollemnt = 0;
           $monthlypayment ->payment_status = 'Pendente';
         $monthlypayment ->payment_date = null;
       setlocale(LC_TIME, 'pt_BR');
           $monthName = utf8_encode(Carbon::parse($monthlypayment->endDate)->formatLocalized('%B'));

       $monthlypayment->update();
         return redirect()->back()->with('msg', 'A mensalidade  do mês de '. $monthName. ' Foi cancelada');
    }
}