<?php

namespace App\Http\Controllers;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
   public function index(Request $request)
    {

        $var =$request->searchcurso;
          $courses = Courses::where('nome', 'like','%'. $var .'%')
          ->orWhere('nivel','like','%'. $var .'%')
          ->paginate(5);
          return view("course.index", ['courses' => $courses, 'searchcurso'=> $var]);

          if ($courses ->isEmpty()) {
            return view('course.index')->with('message', 'Nenhum resultado encontrado para: '.$var);
          }
    }

  
    public function create()
    {
        return view('course.create');
    }


    public function store(Request $request)
    {
         $courses =  Courses::create($request->all());
        $courses->save();
        return redirect()->route("course.index")
                         ->with("success","Curso salvo com sucezsso");//
    }

    public function show($id)
    {
        $course = Courses::find($id);
        return view("course.show", ["course"=> $course]);
    }


    public function edit($id)
    {
        $course = Courses::find($id);
        return view("course.edit", ["course"=> $course]);
    }

    public function update(Request $request, $id)
    {
            $course = Courses::find($id);
            $course->update($request->all());
            return redirect()->route("course.index")
            ->with("success","Course atualizado com sucesso");
    }

    
    public function destroy($id)
    {
       $course = Courses::find($id);
       $course->delete();
       return redirect()->route("course.index")
       ->with("success","Course apagado com sucessso");
    }
}