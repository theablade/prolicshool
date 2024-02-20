<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Http\Requests\TeacherFormRequest;
use Carbon\Carbon;
class TeacherController extends Controller
{
    public function index(Request $request)
    {

    
  


        $var = $request->searchresult;

         $teachers = Teacher::where("nome", "like","%".$var."%")
         ->orWhere("genero","like","%".$var."%")
         ->orWhere("email","like","%".$var."%")
         ->paginate(5)->fragment('teachers');
          return view("teacher.index", ['teachers' => $teachers, 'searchresult'=> $var]);

        if ($teachers->isEmpty()) {
        return view('teacher.index')->with('message', 'Nenhum resultado encontrado para: '.$searchresult);
    }
       
    }

 
    public function create()
    {
         $currentDateTime = Carbon::now();
        $provinces = Province::all();
        $districts = District::all();
        return view("teacher.create", compact('provinces', 'districts', 'currentDateTime'));

    }


    public function store(TeacherFormRequest $request)
    {
   

    $teacher = new Teacher();

        $teacher ->fill($request->all());
    $teacher->save();

    return redirect()->route('teacher.index')->with('success', 'Professor cadastrado com sucesso');
    }

   
    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view("teacher.show", ["teacher"=> $teacher]);
    }

    
    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view("teacher.edit", ["teacher"=> $teacher]);
    }

    
   public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nome' => 'required',
        'email' => 'required|email',
        'genero' => 'required',
        'data_nascimento' => 'required|date',
        'tipodoc' => 'required',
        'numerodoc' => 'required',
        'endereco' => 'required',
        'telefone' => 'required',
        'disciplina' => 'required',
        'data_contratacao' => 'required|date',
        'salario' => 'required|numeric',
    ]);

    $teacher = Teacher::find($id);
    $teacher->update($validatedData);

    return redirect()->route("teacher.index")->with("success", "Editado com sucesso");
}


    
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect()->route("teacher.index")
        ->with("success","apagado com sucesso");
    }


    
}