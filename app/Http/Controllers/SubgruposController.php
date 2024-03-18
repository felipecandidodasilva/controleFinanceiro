<?php

namespace App\Http\Controllers;

use App\Models\grupos;
use App\Models\subgrupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubgruposController extends Controller
{
    public function index()
    {
        $subgrupos =  DB::table('subgrupos')->get();
        $grupos =  DB::table('grupos')->get();
        
        dd($subgrupos);
        return view('subgrupo.index',compact('subgrupos','grupos'));
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
         subgrupos::create($request->all());
        return redirect()->route('subgrupos.index')->with('sucesso', 'Subgrupo cadastrado com sucesso!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(subgrupos $subgrupos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subgrupos $subgrupos,string $id)
    {
        //
        $subgrupo = subgrupos::find($id);
        $subgrupos =  DB::table('subgrupos')->get();
        return view('subgrupo.edit',compact('subgrupo','subgrupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $registro = subgrupos::find($id);
        $registro->update($request->all());
        return redirect()->route('subgrupos.index')->with('sucesso', 'Subgrupo atualizado com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = subgrupos::find($id);
        $registro->delete();
        return redirect()->route('subgrupos.index')->with('sucesso', 'Subrupo excluído com sucesso!!');
    }
}
