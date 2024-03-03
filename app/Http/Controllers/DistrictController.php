<?php


namespace App\Http\Controllers;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
    $var = $request->searchdistrict;
        $districts = District::where("nome", "LIKE", "%" . $var . "%")->paginate(5);

        if ($districts->isEmpty()) {
            Session::flash('toast_error', 'Nenhum resultado encontrado para: ' . $var);
        }

        return view("district.index", ["districts" => $districts, "searchdistrict" => $var]);
      

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $provinces = Province::all();
        return view("district.create", ["provinces"=> $provinces]);
    }

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
{
    $request->validate([
            'province_id' => 'required|exists:provinces',
            'nome' => 'required|string|max:255',
        ]);

        $existingDistrict = District::where('province_id', $request->province_id)
            ->where('nome', $request->nome)
            ->first();

        if ($existingDistrict) {
            return redirect()->back()->withInput()->withErrors(['nome' => 'Já existe um distrito com este nome nesta província']);
        }

        $district = new District();
        $district->province_id = $request->province_id;
        $district->nome = $request->nome;

        $district->save();

        Session::flash('toast_success', 'Distrito criado com sucesso');

        return redirect()->route("district.index");
}


    /**
     * Display the specified resource.
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $districts = District::find($id);
       return view("district.edit", ["districts"=> $districts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $districts = District::find($id);
        $districts->update($request->all());

        Session::flash('toast_success', 'Distrito atualizado com sucesso');

        return redirect()->route("district.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $districts = District::find($id);
        $districts->delete();

        Session::flash('toast_success', 'Distrito apagado com sucesso');

        return redirect()->route("district.index");
    }



}