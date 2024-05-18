@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Edição de {{$infoPagina['titulo']}}</h1>
    {{ Breadcrumbs::render('lancamentos.editar',$lancamento->descricao,$infoPagina['tipoRota'] ) }}
@stop

@section('content')
    @if((session('sucesso')))
        <div class="alert alert-success">
            {{ session('sucesso')}}
        </div>
    @endif
    @if((session('falha')))
        <div class="alert alert-danger">
            {{ session('falha')}}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Editar parcela ({{$itemLancamento->id}}) {{$lancamento->descricao}}</h3>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <form action="{{ route('itemLancamento.update', $itemLancamento->id) }}" method="POST" class="form-horizontal">
                                @csrf
                                @method('PUT')  {{-- Since it's an edit form --}}
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-lg-3 col-sm-6">
                                            <label for="forma_pagamento_id" class="form-label">Forma de Pagamento</label>
                                            <select class="form-control" name="forma_pagamento_id" id="forma_pagamento_id" required>
                                                @forelse ($formaPagamentos as $formaPagamento )
                                                
                                                <option value="{{ $formaPagamento->id}}"
                                                    @if ($formaPagamento->id ==$itemLancamento->forma_pagamento_id )
                                                    selected
                                                    @endif
                                                    >
                                                    {{ $formaPagamento->descricao}}
                                                </option>
                                                
                                                @empty
                                                <p>Sem registros</p>
                                                
                                                @endforelse
                                            </select>
                                        </div>
                                        
                                        <div class="col-lg-3 col-sm-6">
                                            <label for="valor" class="form-label">Valor</label>
                                            <input type="number" step="0.01" class="form-control" name="valor" id="valor" value="{{ old('valor', $itemLancamento->valor) }}" required>
                                        </div>
                                        
                                        <div class="col-lg-3 col-sm-6">
                                            <label for="parcela" class="form-label">Parcela</label>
                                            <input type="number" class="form-control" name="parcela" id="parcela" value="{{ old('parcela', $itemLancamento->parcela) }}" required>
                                        </div>
                                        
                                        <div class="col-lg-3 col-sm-6">
                                            <label for="dt_vencimento" class="form-label">Data de Vencimento</label>
                                            <input type="date" class="form-control" name="dt_vencimento" id="dt_vencimento" value="{{ old('dt_vencimento', $itemLancamento->dt_vencimento) }}" required>
                                        </div>
                                        
                                        <div class="col-lg-3 col-sm-12">
                                            <label for="pago" class="form-label">Pago</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pago" id="pagoSim" value="S" {{ ($itemLancamento->pago == 'S') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pagoSim">
                                                    Sim
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pago" id="pagoNao" value="N" {{ ($itemLancamento->pago == 'N') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pagoNao">
                                                    Não
                                                </label>
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-9 col-sm-12">
                                            <label for="obs" class="form-label">Observação</label>
                                            <textarea class="form-control" name="obs" id="obs" rows="3">{{ old('obs', $itemLancamento->obs) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Salvar</button>
                                    {{-- <button type="submit" class="btn btn-default float-right">Cancelar</button> --}}
                                    <a href="{{ route('itemLancamento.excluir', ['id' => $itemLancamento->id]) }}" class="btn btn-danger float-right">Excluir</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Editar lançamento {{$lancamento->descricao}} ({{$lancamento->id}})</h3>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <form action="{{ route('lancamento.update', $itemLancamento->lancamento_id) }}" method="POST" class="form-horizontal">
                                @method('PUT')  {{-- Since it's an edit form --}}
                                @csrf
                                <input type="hidden" name="tipo_lancamento" value="{{$lancamento->tipo_lancamento}}">
                                <input type="hidden" name="valor" value="{{$lancamento->valor}}">
                                <input type="hidden" name="total_parcelas" value="{{$lancamento->total_parcelas}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-12">
                                            <label for="descricao" class="form-label">Descrição</label>
                                            <input type="text"  class="form-control" name="descricao" id="descricao" value="{{ old('descricao', $lancamento->descricao) }}" required>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label for="subgrupo_id" class="form-label">Sub Grupo</label>
                                            <select class="form-control" name="subgrupo_id" id="subgrupo_id" required>
                                                @forelse ($subgrupos as $subgrupo )
                                            
                                                    <option value="{{ $subgrupo->id}}"
                                                        @if ($subgrupo->id ==$lancamento->subgrupo_id )
                                                            selected
                                                        @endif
                                                        >
                                                        {{ $subgrupo->descricao}}
                                                    </option>
                                                    
                                                    @empty
                                                    <p>Sem registros</p>
                                                    
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label for="forma_pagamento_id" class="form-label">Forma de Pagamento</label>
                                            <select class="form-control" name="forma_pagamento_id" id="forma_pagamento_id" required>
                                                @forelse ($formaPagamentos as $formaPagamento )
                                            
                                                    <option value="{{ $formaPagamento->id}}"
                                                        @if ($formaPagamento->id ==$itemLancamento->forma_pagamento_id )
                                                            selected
                                                        @endif
                                                        >
                                                        {{ $formaPagamento->descricao}}
                                                    </option>
                                                    
                                                    @empty
                                                    <p>Sem registros</p>
                                                    
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <label for="dt_compra" class="form-label">Data da compra</label>
                                            <input type="date" class="form-control" name="dt_compra" id="dt_compra" value="{{ old('dt_compra', $lancamento->dt_compra) }}" required>
                                        </div>
                                        <div class="col-lg-2 col-sm-6">
                                            <label for="valor" class="form-label">Valor</label>
                                            <input type="number"  disabled step="0.01" class="form-control" name="valor" id="valor" value="{{ old('valor', $lancamento->valor) }}" required>
                                        </div>
                                        <div class="col-lg-2 col-sm-6">
                                            <label for="total_parcelas" class="form-label">Total Parcela</label>
                                            <input type="number" disabled class="form-control" name="total_parcelas" id="total_parcelas" value="{{ old('parcela', $lancamento->total_parcelas) }}" required>
                                        </div>
                                        <div class="col-lg-8 col-sm-12">
                                            <label for="obs" class="form-label">Observação</label>
                                            <textarea class="form-control" name="obs" id="obs" rows="3">{{ old('obs', $lancamento->obs) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Salvar</button>
                                    <a href="{{ route('lancamento.excluir', ['id' => $itemLancamento->lancamento_id]) }}" class="btn btn-danger float-right">Excluir</a>
                                </div>
                                
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Adicionar Parcelas</h3>
                        </div>
                        <div class="m-2">
                            <form action="{{ route('itemLancamento.add', $lancamento->id) }}" method="GET" class="form-inline">
                                @csrf

                                <form class="form-inline">
                                    <div class="form-group mb-2">
                                      <label for="addQtdParc" class="">Quantidade</label>
                                      <input type="number"  name="addQtdParc" id="addQtdParc" class="form-control" aria-label="Quantidade Parcela">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                      <label for="addVlrParc"> Valor Parcela</label>
                                      <input type="number" step="0.01" name="addVlrParc" id="addVlrParc" class="form-control" aria-label="Valor Parcela" value="{{$itemLancamento->valor}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary mb-2"> + </button>
                                  </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                        <h3 class="card-title">Demais Parcelas  @dinheiro($infoPagina['parcelasPagas']) | @dinheiro($infoPagina['parcelasAVencer']) |  @dinheiro($infoPagina['parcelasTotais'])</h3>
                        </div>
                            <table class="table table-hover text-nowrap table-responsive">
                                <thead>
                                    <tr>
                                        <th>Data Vencimento</th>
                                        <th>Valor</th>
                                        <th>Parcela</th>
                                        <th>Pago</th>
                                        <th>#</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($demaisParcelas as $parcela)
                                        <tr>
                                        <td>@dataBr($parcela->dt_vencimento)</td>
                                        <td>{{$parcela->parcela}}</td>
                                        <td>@dinheiro($parcela->valor)</td>
                                        <td>@if ($parcela->pago == 'S')
                                                Pago
                                            @else
                                                A Pagar
                                            @endif
                                        </td>
                                        </td>
                                        @if ($parcela->pago == 'S')
                                                <td><a class="btn btn-block btn-success" href="{{ route('lancamento.baixar', ['id' => $parcela->id,'pago' =>'N'])}}"> <i class="fa fa-edit"></i> Retorno</a></td>
                                                @else
                                                <td><a class="btn btn-block btn-secondary" href="{{ route('lancamento.baixar', ['id' => $parcela->id,'pago' =>'S'])}}"> <i class="fa fa-edit"></i> Baixar</a></td>
                                            @endif
                                        <td><a class="btn btn-block btn-warning" href="{{ route('lancamento.edit', [$parcela->id])}}"> <i class="fa fa-edit"></i> Editar</a></td>
                                        <td>
                                            <form action="{{ route('itemLancamento.excluir',  $parcela->id )}}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-block btn-danger">Excluir</button>
                                            </form>
                                        </td>
                                        {{-- <td><a class="btn btn-block btn-warning" href="{{ route('lancamento.gerar', [$lancamento->id])}}"> <i class="fa fa-edit"></i> Gerar</a></td> --}}
                                        </tr>
                                        @empty
                                        <p>Sem dados cadastrados</p>
                                    @endforelse
                                </tbody>
                            </table>
                        
                    
                    </div>
                </div>
            </div>
        </div>
  
    </div>
    
@stop
