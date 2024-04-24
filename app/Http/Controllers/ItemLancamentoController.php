<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Updateitem_lancamentoRequest;
use App\Models\Item_lancamento;
use App\Models\Datas;
use App\Models\Lancamento;

class ItemLancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(item_lancamento $item_lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(item_lancamento $item_lancamento)
    {
        dd('editar');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, item_lancamento $item_lancamento, $id)
    {
        $registro = item_lancamento::find($id);
        $registro->update($request->all());
        return redirect()->route('lancamento.edit',[$id])->with('sucesso', 'Parcela atualizada com sucesso!!');
    }
    public function adicionar(Lancamento $lancamento, Request $request, $id)
    {

        $lancamento = $lancamento::find($id);
        $itens = Item_lancamento::where('lancamento_id',$id);
        $dtUltimaParc = $itens->max('dt_vencimento'); 
        $ultimaParcela = $itens->max('parcela');
        // dd($dtUltimaParc,$ultimaParcela);
        // dd($request->all());
        $dt_vencimento = Datas::retornaPrimeiroVencimento($lancamento->forma_pagamento_id,$dtUltimaParc);

        // dd($dt_vencimento);

        $totalParcelas = $ultimaParcela + $request->addQtdParc;


        // Fazendo loop para adicionar parcelas

        
        for ($i=$request->addQtdParc; $i < $totalParcelas; $i++) { 
            
            if($i > 0)
                {
                    $dt_vencimento = Datas::adicionaMes($dt_vencimento);
                }
                // echo $dt_vencimento . "<br>";
                $item = Item_lancamento::create([
                   'lancamento_id' => $lancamento->id,
                   'forma_pagamento_id' => $lancamento->forma_pagamento_id,
                   'valor' => $request->addVlrParc,
                   'parcela' => $i,
                   'dt_vencimento' =>$dt_vencimento ,
                   'pago' => false,
                ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $registro = Item_lancamento::find($id);
        
        if ($registro->pago == 'S')
        {
            return redirect()->route('lancamento.edit',[$id])->with('falha', 'Lançamento já pago!!');

        };

        $lancamento = Lancamento::find($registro->lancamento_id);
        $tipo = $lancamento->tipo_lancamento;
        $registro->delete();
        return redirect()->route('lancamentos.index',[$tipo])->with('sucesso', 'Parcela excluída com sucesso!!');
    }
}
