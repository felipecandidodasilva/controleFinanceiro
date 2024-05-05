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

        if (empty($request->addVlrParc) || empty($request->addQtdParc)) {
            return redirect()->back()->with('falha', 'Quantidade e valor devem ser preenchidos!!');
        }

        $lancamento = $lancamento::find($id);
        $itens = Item_lancamento::where('lancamento_id',$id);
        $dtUltimaParc = $itens->max('dt_vencimento'); 
        $ultimaParcela = $itens->max('parcela');
        // dd($request->all());
        $dt_vencimento = Datas::retornaPrimeiroVencimento($lancamento->forma_pagamento_id,$dtUltimaParc);
        
        

        // dd($dt_vencimento);
        
        $totalParcelas = $ultimaParcela + $request->addQtdParc;
        
        // dd($request->addQtdParc,$ultimaParcela,$dt_vencimento,$totalParcelas);

        // Fazendo loop para adicionar parcelas

        // echo "Última parcela: " . $ultimaParcela . "<br>";
        // echo "Parcelas adicionadas: " . $request->addQtdParc . "<br>";
        // echo "Total parcelas: " . $totalParcelas . "<br>";
        
        for ($i=$ultimaParcela; $i < $totalParcelas +1; $i++) { 
            
            
                $dt_vencimento = Datas::adicionaMes($dt_vencimento);
                // echo $i . "<br>";
                $item = Item_lancamento::create([
                   'lancamento_id' => $lancamento->id,
                   'forma_pagamento_id' => $lancamento->forma_pagamento_id,
                   'valor' => $request->addVlrParc,
                   'parcela' => $i,
                   'dt_vencimento' =>$dt_vencimento ,
                   'pago' => 'N',
                ]);
                
            }
            // dd("fim");

        $itens = new Item_lancamento();
        
        // Atualizando o total do lançamento e o número de parcelas
        $lancamento->valor = $itens->valorTotalParcelas($id);
        $lancamento->total_parcelas = $i; // Veio do count do for
        $lancamento->update();

        return redirect()->back()->with('sucesso', 'Parcelas adicionadas com sucesso!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $registro = Item_lancamento::find($id);
        $lancamento_id = $registro->lancamento_id;
        
        if ($registro->pago == 'S')
        {
            return redirect()->back()->with('falha', 'Lançamento já pago!!');

        };

        $lancamento = Lancamento::find($lancamento_id);
        $tipoLancamento = $lancamento->tipo_lancamento;
        
        // $totalParcelas = Item_lancamento::totalParcelas($lancamento_id);
        $totalParcelas = $lancamento->item_lancamento->count();
        // dd($totalParcelas);
        
        $registro->delete();
        
        //Deletando o lançamento se houver somente um registro
        if ($totalParcelas == 1 ) {
            $lancamento->delete();
        } else {
            $lancamento = Lancamento::find($lancamento_id);
            // dd($lancamento->item_lancamento->count());
            $lancamento->redefinirTotalParcelas();
            $lancamento->redefinirValorTotal();
        }
        return redirect()->route('lancamentos.index',[$tipoLancamento])->with('sucesso', 'lançamento excluído com sucesso!!');
        // return redirect()->back()->with('sucesso', 'Parcela excluída com sucesso!!');
    }
}
