<?php

namespace App\Http\Controllers;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    
   {

    $var = $request->searchprovince;
        $provinces = Province:: where('nome', 'like','%'.$var.'%')
        ->orWhere('capital','like','%'.$var.'%')-> paginate(5);
        
         return view("province.index", ['provinces' => $provinces, 'searchprovince'=> $var]);

         if ($provinces ->isEmpty()) {
              return view('discipline.index')->with('message', 'Nenhum resultado encontrado para: '.$searchprovince);
         }

}
   
    public function create()
    {
        return view("province.create");
    }

    public function store(Request $request)
    {
         $provinces = Province::create($request->all());
        return redirect()->route("province.index")
                         ->with("success","Provincia salva com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $province_id)
    {
        $provinces = Province::find($province_id);
        return view("province.show", ["province"=> $provinces]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $province_id)
    {
        $provinces = Province::find($province_id);
        return view("province.edit", ["province"=> $provinces]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $province_id)
    {
        $provinces = Province::find($province_id);
        $provinces->update($request->all());
        $provinces->save();
        return redirect()->route("province.index")
        ->with("success","provincia atualizada com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $province_id)
    {
        $provinces = Province::find($province_id);
        $provinces->delete();
        return redirect()->route("province.index")
        ->with("success","Apagado  com sucesso");
    }
}