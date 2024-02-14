<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Courses;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MonthlyPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $var = $request->searchresult;
         $monthlypayment = DB::table('enrollment as e') 
            ->join('students as s', 'e.student_id', '=', 's.id'  )
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->select('e.id', 'e.status', 's.nome as student', 's.ntelefone', 'c.nome as course', 'c.price_enrollemnt', 'c.price_subscrab')
            ->where('s.nome', 'LIKE', '%'.$var.'%')
            ->orWhere('c.nome', 'LIKE', '%'.$var.'%')
         ->paginate(5);
         


         return view("monthlypayment.index", [
        'monthlypayments' => $monthlypayment,
        'searchresult' => $var,
            ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

         $students = Student::all();
        $courses = Courses::all();
         return view("monthlypayment.create", compact('students', 'courses'));
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
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