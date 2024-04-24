<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLancamentoRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateLancamentoRequest;
use App\Models\Datas;
use App\Models\FormaPagamento;
use App\Models\Item_lancamento;
use App\Models\Lancamento;
use App\Models\grupos;
use App\Models\subgrupos;
use Illuminate\Support\Facades\DB;
use DateTime;


class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $tipoRota, Request $request)
    {
        //   $lancamentos = Lancamento::all();
        $tipo = $tipoRota == 'entradas' ? 'E' : 'S';
        $tipo = $request->tipo_lancamento ? $request->tipo_lancamento : $tipo; 
        $filtroLancamento = $request->lancamento ? $request->lancamento : NULL;



        // dd($tipo);

        $tituloPagina = $tipo == 'E' ? 'Entradas' : 'Saídas';

            // $lancamentos = Lancamento::with(['formaPagamento','subgrupo'])->where('tipo_lancamento', $tipo)->orderBy('descricao')->get();

        $lancamentos = DB::table('item_lancamentos')
            ->join('lancamentos', 'lancamentos.id', '=', 'item_lancamentos.lancamento_id')
            ->join('forma_pagamentos', 'forma_pagamentos.id', '=', 'item_lancamentos.forma_pagamento_id')
            ->join('subgrupos', 'subgrupos.id', '=', 'lancamentos.subgrupo_id')
            ->select('item_lancamentos.id',
            'item_lancamentos.dt_vencimento',
            'item_lancamentos.valor',
            'item_lancamentos.parcela',
            'item_lancamentos.pago',
            'lancamentos.descricao as lancamento',
            'lancamentos.total_parcelas',
            'lancamentos.dt_compra',
            'forma_pagamentos.descricao as formaPagamento',
            'subgrupos.descricao as subgrupo' )
            ->where('tipo_lancamento', $tipo);
            
            
            // FILTROS 
            if ($request->dt_ini) {
                $filtroDtIni = $request->dt_ini;
                $filtroDtFim = $request->dt_fim;
            } else {
                $filtroDtIni = Datas::obterPrimeiroDiaDoMes(date('Y-m-d'));
                $filtroDtFim = Datas::obterUltimoDiaDoMes(date('Y-m-d'));
            }
            
            $lancamentos = $lancamentos->whereBetween('dt_vencimento',[$filtroDtIni, $filtroDtFim] );

            
            if ($request->forma_pagamento_id || $request->forma_pagamento_id != 0) {
                $lancamentos->where('item_lancamentos.forma_pagamento_id', $request->forma_pagamento_id);
            }

            if ($request->subgrupo_id || $request->subgrupo_id != 0) {
                $lancamentos->where('lancamentos.subgrupo_id', $request->subgrupo_id);
            }

            if ($request->lancamento || $request->lancamento != 0) {
                $lancamentos->where('lancamentos.descricao', 'like', '%' . $request->lancamento . '%');
            }

        // FILTROS 
        
        
        $vlrTotal = Item_lancamento::whereBetween('dt_vencimento',[$filtroDtIni, $filtroDtFim])->sum('valor');
        $vlrPago = Item_lancamento::whereBetween('dt_vencimento',[$filtroDtIni, $filtroDtFim])->where('pago','S')->sum('valor');
        $vlrAPagar = Item_lancamento::whereBetween('dt_vencimento',[$filtroDtIni, $filtroDtFim])->where('pago','N')->sum('valor');

        $subTotal = [
           'vlrTotal' => $vlrTotal,
           'vlrPago' => $vlrPago,
           'vlrAPagar' => $vlrAPagar
        ];

        // $vlrPago = $lancamentos->where('item_lancamentos.pago','S')->sum('item_lancamentos.valor');
        // $vlrApagar = $lancamentos->where('item_lancamentos.pago','N')->sum('item_lancamentos.valor');

        //     dd($vlrPago,$vlrApagar,$vlrTotal);
        $lancamentos = $lancamentos
            ->orderBy('item_lancamentos.pago')
            ->orderBy('dt_vencimento')
            ->orderBy('item_lancamentos.created_at')
            ->get();


        $infoPagina = [
            'titulo' => $tituloPagina,
            'tipoLancamento' => $tipo,
            'tipoRota' => $tipoRota
        ]; 

        $filtros = [
            'dt_ini' => $filtroDtIni,
            'dt_fim' => $filtroDtFim,
            'lancamento' => $filtroLancamento,
            'forma_pagamento_id' => $request->forma_pagamento_id,
            'subgrupo_id' =>$request->subgrupo_id,
        ];
        // dd($filtros);

        $subgrupos = subgrupos::orderBy('descricao')->get();
        $formaPagamentos = FormaPagamento::orderBy('descricao')->get();
        
        
        // dd($subgrupos);
        return view('lancamento.index',compact('lancamentos','infoPagina','subgrupos','formaPagamentos','filtros','subTotal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('oi');
    }

    public function store(request $request)
    {
        // dd($request->all());
        $lancamento = Lancamento::create($request->all());
        $this->gerarParcelas($lancamento);

        $tipoRota = $request->tipo_lancamento == 'E' ? 'entradas' : 'saidas';

        return redirect()->route('lancamentos.index',['tipo' => $tipoRota])->with('sucesso', 'lançamento cadastrado com sucesso!!');

    }
    public function show(Lancamento $lancamento)
    {
        //
    }
    public function edit(Item_lancamento $item,$id)
    {
        $itemLancamento = $item::with('formaPagamento')->with('lancamento')->where('id',$id)->get();
        $itemLancamento = $item::find($id);

        $demaisParcelas = $item::where('lancamento_id',$itemLancamento->lancamento_id)->get();

        $lancamento = Lancamento::find($itemLancamento->lancamento_id);
        $subgrupos =  subgrupos::all();
        $formaPagamentos = FormaPagamento::orderBy('descricao')->get();

       
        $tituloPagina = $itemLancamento->lancamento->tipo_lancamento == 'E' ? 'Editar Entradas' : 'Editar Saídas';
        $tipoRota = $itemLancamento->lancamento->tipo_lancamento == 'E' ? 'entradas' : 'saidas';

        $infoPagina = [
            'titulo' => $tituloPagina,
            'tipoLancamento' => $itemLancamento->lancamento->tipo_lancamento,
            'tipoRota' => $tipoRota
        ]; 
        return view('lancamento.edit',compact('itemLancamento','infoPagina','subgrupos','formaPagamentos','lancamento','demaisParcelas'));
    }
    public function update(Request $request, Lancamento $lancamento, $id)
    {
        $registro = Lancamento::find($id);
        // dd($request->all());

        // atualizando as parcelas
        $updatedCount = Item_lancamento::where('lancamento_id',$registro->id)->where('pago','N')->update([
            'forma_pagamento_id' => $request->forma_pagamento_id,
            'obs' => $request->obs,
        ]);

        // Atualizando o lançamento
        $registro->update($request->all());

        return redirect()->back()->with('sucesso', "Lançamento atualizado, $updatedCount parcelas atualizadas!!");
    }
    public function destroy($id)
    {
        $registro = Lancamento::find($id);
        $parcelasPagas = Item_lancamento::where('lancamento_id',$registro->id)->where('pago','S')->count();
        
        
        if ($parcelasPagas > 0)
        {
            return redirect()->back()->with('falha', 'Existem parcelas já pagas, estorne-as primeiro!!');
            
        };
        
        
        $parcelasDeletadas = Item_lancamento::where('lancamento_id',$registro->id)->delete();
        $tipo = $registro->tipo_lancamento;
        $registro->delete();

        return redirect()->route('lancamentos.index',[$tipo])->with('sucesso', "Lançamento excluído com sucesso, $parcelasDeletadas parcelas excluídas!!");
    }
    public function baixar($id,$pago)
    {
        $registro = Item_lancamento::find($id);
        $lancamento = Lancamento::find($registro->lancamento_id);
        $tipo = $lancamento->tipo_lancamento;
        $registro->pago = $pago;
        $registro->save();
        
        return redirect()->route('lancamentos.index',[$tipo])->with('sucesso', 'Lançamento excluído com sucesso!!');
    }
    public function gerarParcelas(Lancamento $lancamento)
    {

        $dt_vencimento = Datas::retornaPrimeiroVencimento($lancamento->forma_pagamento_id,$lancamento->dt_compra);

        // dd($dt_vencimento);

        $valorparcela = $lancamento->valor / $lancamento->total_parcelas; 
        
        for ($i=0; $i < $lancamento->total_parcelas; $i++) { 
            
            if($i > 0)
                {
                    $dt_vencimento = Datas::adicionaMes($dt_vencimento);
                }
                echo $dt_vencimento . "<br>";
            
                $item = Item_lancamento::create([
                   'lancamento_id' => $lancamento->id,
                   'forma_pagamento_id' => $lancamento->forma_pagamento_id,
                   'valor' => $valorparcela,
                   'parcela' => $i==0 ? 1 : $i+1,
                   'dt_vencimento' =>$dt_vencimento ,
                   'pago' => false,
                ]);

        }
    }
   

 
}
