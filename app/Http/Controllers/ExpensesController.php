<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $var = $request->searchresult;
         $expenses = Expenses::where("tipo", "LIKE","%". $var ."%")
         ->orWhere("transacao","LIKE","%". $var ."%")
         ->orWhere("data","LIKE","%". $var ."%")

         ->paginate(5);



         return view("expenses.index", [
        'expenses' => $expenses,
        'searchresult' => $var,
            ]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    $request->validate([
        'tipo' => 'required',
        'transacao' => 'required',
        'valor' => 'required|numeric',
        'data' => 'required|date',
     
    ]);

    $expense = new Expenses();
    $expense->tipo = $request->tipo;
    $expense->transacao = $request->transacao; 
    $expense->valor = $request->valor;
    $expense->data = $request->data;
    $expense->descricao = $request->descricao;
    $expense->save();

   
    return redirect()->route("expenses.index")
                     ->with("success", "Despesa criada e salva com sucesso!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expenses::find($id);
          return view("expenses.show", compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense  = Expenses::findOrFail($id);
        return view("expenses.edit", compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $expense = Expenses::find($id);

    $expense->update($request->all());

    
     return redirect()->route("expenses.index")
            ->with("success","Dispesa atualizado com sucesso");;
    }


    public function destroy(string $id)
    {
         $expenses = Expenses::findOrFail($id);
        $expenses->delete();
        return redirect()->route("expenses.index")
                         ->with("success","Dispesa excluída com sucesso");
    }
}