<?php

namespace App\Http\Controllers;

use App\Models\FormaPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $formasDePagamento = FormaPagamento::orderBy('descricao');
        $formasDePagamento =  DB::table('forma_pagamentos')->get();
        
        return view('formapagamento.index',compact('formasDePagamento'));
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
         FormaPagamento::create($request->all());
        return redirect()->route('formasdepagamento.index')->with('sucesso', 'Forma cadastrada com sucesso!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FormaPagamento $formaPagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormaPagamento $formaPagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormaPagamento $formaPagamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = FormaPagamento::find($id);
        $registro->delete();
        return redirect()->route('formasdepagamento.index')->with('sucesso', 'Forma excluída com sucesso!!');
    }
}
