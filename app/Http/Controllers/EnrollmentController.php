<?php

namespace App\Http\Controllers;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Courses;
use App\Http\Requests\EnrollmentFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\MonthlyPayment;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {

        $var = $request->searchresult;
         $enrollment = DB::table('enrollment as e') 
            ->join('students as s', 'e.student_id', '=', 's.id'  )
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->select('e.id', 'e.status', 's.nome as student', 's.ntelefone', 'e.student_id', 'c.nome as course', 'c.price_enrollemnt', 'c.price_subscrab')
            ->where('s.nome', 'LIKE', '%'.$var.'%')
            ->orWhere('c.nome', 'LIKE', '%'.$var.'%')
         ->paginate(5);
         


         return view("enrollment.index", [
        'enrollments' => $enrollment,
        'searchresult' => $var,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        $currentDateTime = Carbon::now();
        $students = Student::all();
        $courses = Courses::all();
         return view("enrollment.create", compact('students', 'courses', 'currentDateTime'));
    }


    public function store(EnrollmentFormRequest $request)
    {
        try{
        DB::beginTransaction();
        $enrollment = new Enrollment;
        $enrollment->fill($request->all());
        $enrollment->save();
  
            
        for ($i = 0; $i < 3; $i++) {

        $date = Carbon::now()->startOfMonth();

        $month = new MonthlyPayment();
        $month->endDate =$date;
        $month->type_payment = $enrollment->type_payment;

        $month ->student_id = $enrollment->student_id;
        $month ->course_id = $enrollment->course_id;

        if ($i ==0) {
             $month->payment_status ='Pago';
            $month ->price_enrollemnt = $request->price_enrollemnt;
                    $month->payment_date = $enrollment->enrollment_date;
        }else{
             $month->payment_status ='Pendente';
            $month ->price_enrollemnt = 0;
        }
         $month ->enrollment_id = $enrollment->id;
        
         $date->addMonths($i);
        $month->save();




        }

        DB::commit();
        return redirect()->route("enrollment.index")
                         ->with("success","Curso salvo com sucesso");
        }catch(\Exception $err){
            DB::rollBack();
        }
       

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
         $enrollment = DB::table('enrollment as e') 
            ->join('students as s', 'e.student_id', '=', 's.id'  )
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->select('e.id', 'e.status', 'e.status', 's.nome as student', 's.ntelefone', 'c.nome as course', 'c.price_enrollemnt', 'c.price_subscrab')
            ->where('e.student_id', '=', $id)
            ->get();

        return view('enrollment.show', ['enrollments' => $enrollment]);
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
        $enrollmentStatus = Enrollment::findOrFail($id);

        $enrollment = Enrollment::findOrFail($id);
        if($enrollmentStatus ->status =="Activo"){
        $enrollment -> status = 'Cancelada';
       
      
        }elseif($enrollmentStatus ->status =="Cancelada"){
           
       
        $enrollment -> status = 'Activo';
    }else{
          $enrollment -> status = 'Activo';
    }
        $enrollment -> update();
        
    return redirect()->route('enrollment.index') 
      ->with('success','Matricula '.$enrollmentStatus->status);
       
    }


  public function PDFLimpo()
{


         $enrollments = DB::table('enrollment as e') 
            ->join('students as s', 'e.student_id', '=', 's.id'  )
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->select('e.id', 'e.status', 'e.status', 's.nome as student', 's.ntelefone', 'type_payment', 's.number_doc', 'c.nome as course', 'c.price_enrollemnt', 'c.price_subscrab')
        
            ->get();


    $pdf = FacadePdf::loadView('enrollment.pdf', compact('enrollments'));
    $pdf->setPaper('A4', 'portrait');
    return $pdf->stream('enrollments.pdf');
}

public function PDFUser($parametro)
{
    if ($parametro) {
      
        $primeirasTresLetras = substr($parametro, 0, 3);

      
        $enrollments = DB::table('enrollment as e')
            ->join('students as s', 'e.student_id', '=', 's.id')
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->select('e.id', 'e.status', 'e.status', 'type_payment', 's.nome as student', 's.ntelefone', 'c.nome as course', 'c.price_enrollemnt', 'c.price_subscrab')
            ->where('s.nome', 'LIKE', $primeirasTresLetras . '%')
            ->get();

      
        if ($enrollments->isEmpty()) {
            return "Nenhuma matrícula encontrada para os estudantes com as três primeiras letras do nome fornecido.";
        }

      
        $pdf = FacadePdf::loadView('enrollment.pdf', compact('enrollments'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('enrollment.pdf');
    }
}

public function ReciboUser(String $id)
{
    $enrollments = DB::table('enrollment as e') 
            ->join('students as s', 'e.student_id', '=', 's.id'  )
            ->join('courses as c', 'e.course_id', '=', 'c.id')
            ->select('e.id', 'e.status', 'e.status', 's.nome as student', 's.ntelefone', 'type_payment', 'c.nome as course', 'c.price_enrollemnt', 'c.price_subscrab')
            ->where('e.student_id', '=', $id)
            ->get();

         $pdf = FacadePdf::loadView('enrollment.pdfr', compact('enrollments'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('enrollment.pdf');

     
}



    
}