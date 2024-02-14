<?php

namespace App\Http\Controllers;
use App\Models\Disciplines;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{public function index(Request $request)
{
    $var = $request->searchdiscipline;
    $disciplines = Disciplines::where('nome', 'like', '%' . $var . '%')
        ->orWhere('descricao', 'like', '%' . $var . '%')->paginate(3);

    
    if ($disciplines->isEmpty()) {
        return view('discipline.index')->with('message', 'Nenhum resultado encontrado para: ' . $var);
    }

    
    return view("discipline.index", ['disciplines' => $disciplines, 'searchdiscipline' => $var]);
}

   
    public function create()
    {
       return view('discipline.create');
    }

    public function store(Request $request)
    {
        $disciplines = Disciplines::create($request->all());
        $disciplines->save();
        return redirect()->route("discipline.index")
                         ->with("success","Estudante salvo com sucezsso");
    }

   
    public function show($id)
    {
          $disciplene = Disciplines::findOrFail($id);
        return view('discipline.show', ['discipline' => $disciplene]);
    }

    
    public function edit($id)
    {
            $discipline = Disciplines::findOrFail($id);
            return view('discipline.edit', compact('discipline'));
    }

    public function update(Request $request, $id)
    {
        $discipline = Disciplines::findOrFail($id);
        $discipline->update($request->all());
        return redirect()->route('discipline.index') 
        ->with('success','Disciplina atualizada');
    }

    
    public function destroy($id)
    {
        $discipline = Disciplines::findOrFail($id);
        $discipline->delete();
        return redirect()->route('discipline.index')
        ->with('success','disciplina apagada com sucesso');
    }
}