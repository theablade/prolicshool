<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Province;
use App\Models\District;
use App\Http\Requests\studentFormRequest;
use Illuminate\Http\Request;
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
        $provinces = Province::all();
        $districts = District::all();
         return view("student.create", compact('provinces', 'districts'));
    }

 
    public function store(studentFormRequest $request)
    {
        

    $student = Student::create($request->all());
    return redirect()->route("student.index")->with("msg", "Estudante salvo com sucesso");
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        
        
        return view('student.show', ['student' => $student]);
    }


    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view("student.edit", compact('student'));
    }

    
    public function update(Request $request, $id)
    {
       $student = Student::findOrFail($id);
        $student->update($request->all());
        return redirect()->route("student.index")
                         ->with("msg","Estudante atualizado com sucesso");
    }

   
    public function destroy($id)
    {
         $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route("student.index")
                         ->with("msg","Estudante excluído com sucesso");
    }

    
}