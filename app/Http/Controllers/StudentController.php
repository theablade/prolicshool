<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Province;
use App\Models\District;
use App\Http\Requests\studentFormRequest;
use Illuminate\Http\Request;
use App\Events\StudentCreated;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;

class StudentController extends Controller
{
        public function index(Request $request)
    {
        $var = $request->searchresult;
         $students = Student::where("nome", "LIKE","%". $var ."%")
         ->orWhere("genero","LIKE","%". $var ."%")
         ->paginate(5);
         


         return view("student.index", [
        'students' => $students,
        'searchresult' => $var,
            ]);
    }

    

    public function create()
    {
         $currentDateTime = Carbon::now();
        $provinces = Province::all();
        $districts = District::all();
        
        return view("student.create", compact('provinces', 'districts', 'currentDateTime'));
    }

 
    public function store(studentFormRequest $request)
    {
       $student = new Student;

            $imageName = null;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $newFileName = $file->hashName(); 
            $file->storeAs('img', $newFileName, 'public');
            $imageName = $newFileName;
        }
    
        $student->fill($request->all());
        $student['img'] = $imageName;


   
    $student->save();

        event(new StudentCreated($student));
    return redirect()->route("student.index")->with("msg", "Estudante salvo com sucesso");
    }


    public function show($id)
    {

      


        $student = Student::find($id);

        $province = DB::table('provinces')
        ->where('province_id','=',$student->provincia )
        ->first();
  
   
        
        $district = DB::table('districts')
        ->where('id','=',$student->distrito )
        ->first();



        
        return view('student.show', ['student' => $student, 'province'=>$province, 'district'=>$district]);
    }


    public function edit($id)
    {
        $provinces = Province::all();
        $districts = District::all();
        $student = Student::findOrFail($id);
        return view("student.edit", compact('student','provinces', 'districts'));
    }

    
    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    // Atualizar a imagem, se uma nova imagem foi enviada
    if ($request->hasFile('img')) {
        $path = $request->file('img')->store('public/images');
        $student->img_path = $path;
    }

    // Obter o valor selecionado da província
    $provinciaSelect = $request->input('provincia');
    $student->provincia = $provinciaSelect;

    // Verificar se a província selecionada existe no banco de dados
    $province = DB::table('provinces')->where('nome', $provinciaSelect)->first();

    if ($province) {
        // Atualizar o campo 'provincia' do estudante com o ID da província
        $student->provincia = $province->province_id;
    }

   $distritoSelect = $request->input('distrito');
    $student->distrito = $distritoSelect;

    // Verificar se o distrito selecionado existe no banco de dados
    $district = DB::table('districts')->where('nome', $distritoSelect)->first();

    if ($district) {
        // Atualizar o campo 'distrito' do estudante com o ID do distrito
        $student->distrito = $district->id;
    }

    // Atualizar outros campos do estudante, exceto 'img', 'provincia' e 'distrito'
    $student->update($request->except('img', 'provincia', 'distrito'));

    return redirect()->route("student.index")->with("msg", "Estudante atualizado com sucesso");
}

   
    public function destroy($id)
    {
         $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route("student.index")
                         ->with("msg","Estudante excluído com sucesso");
    }

  public function PDFUser($parametro)
{
    if ($parametro) {
         $students = Student::where("nome", "LIKE","%". $parametro ."%")
         ->orWhere("genero","LIKE","%". $parametro ."%")
         ->get();
         

	  		$pdf= FacadePdf::loadView('student.pdf', compact('students'));
			$pdf->setPaper('A4','portrait');
			return $pdf->stream('estudante.pdf');
    }
}

	public function PDFLimpo()
	{
		 
		    $students = Student::all();


	  		$pdf= FacadePdf::loadView('student.pdf', compact('students'));
			$pdf->setPaper('A4','portrait');
			return $pdf->stream('estudante.pdf');
	}

    
}