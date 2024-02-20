<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Province;
use App\Models\District;
use App\Http\Requests\studentFormRequest;
use Illuminate\Http\Request;
use App\Events\StudentCreated;
use Carbon\Carbon;
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

    

    $student->fill($request->all());

   
    $student->save();

        event(new StudentCreated($student));
    return redirect()->route("student.index")->with("msg", "Estudante salvo com sucesso");
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        
        
        return view('student.show', ['student' => $student]);
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


    if ($request->hasFile('img')) {
    
        $path = $request->file('img')->store('public/images');
        $student->img_path = $path;
    }

    $student->update($request->except('img'));

    

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