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
    
    // Executa a consulta para obter os dados
    $monthlypayment = DB::table('monthly_payment as m')
    ->join('students as s', 'm.student_id', '=', 's.id'  )
    ->join('courses as c', 'm.course_id', '=', 'c.id')
        ->select('m.id', 'm.payment_status','s.nome as student', 'm.price_enrollemnt', 'm.type_payment', 'c.nome as course', 'm.payment_date', 'm.student_id')
        
        ->paginate(5);  

    // Verifica se há resultados
    if ($monthlypayment->isEmpty()) {
     
        return view("monthlypayment.index", [
            'monthlypayments' => $monthlypayment,
            'searchresult' => $var,
            'noResults' => true, // Adiciona uma flag para indicar que não há resultados
        ]);
    } else {
        // Se houver resultados, renderiza a view com os resultados
        return view("monthlypayment.index", [
            'monthlypayments' => $monthlypayment,
            'searchresult' => $var,
            'noResults' => false, // Adiciona uma flag para indicar que há resultados
        ]);
    }
}

    /**
     * Show the form for creating a new resource.
     */
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
                         ->with("success","Curso salvo com sucesso");
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}