<?php

namespace App\Http\Controllers;

use App\Models\grupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GruposController extends Controller
{
    public function index()
    {

        $grupos =  grupos::orderBy('descricao')->get();
        $infoPagina = [
            'titulo' => 'Grupos'
        ];
        // $grupos =  DB::table('grupos')->get();
        
        return view('grupo.index',compact('grupos','infoPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         grupos::create($request->all());
        return redirect()->route('grupos.index')->with('sucesso', 'Grupo cadastrado com sucesso!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(grupos $grupos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grupos $grupos,string $id)
    {
        //
        $grupo = grupos::find($id);
        $grupos =  grupos::all();
        $infoPagina = [
            'titulo' => 'Grupos'
        ];
        return view('grupo.edit',compact('grupo','grupos','infoPagina'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $registro = grupos::find($id);
        $registro->update($request->all());
        return redirect()->route('grupos.index')->with('sucesso', 'Grupo atualizado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = grupos::find($id);
        $registro->delete();
        return redirect()->route('grupos.index')->with('sucesso', 'Grupo excluído com sucesso!!');
    }
}
