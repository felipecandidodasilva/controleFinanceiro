@extends('adminlte::page')

@section('title', 'Financeiro')

@section('content_header')
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
  
@stop

@section('content')
    <div class="row">
        <div class="col">
            <div class="card"> 
                <div class="card-body">
                    <div class="card card-info">
                        <form action="{{ route('lancamentos.filtros',['tipo' => $infoPagina['tipoRota'] ] ) }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="card-body table-responsive p-2">
                                <div class="row">
                                        @csrf
                                        <input type="hidden" value="{{$infoPagina['tipoLancamento']}}" name='tipo_lancamento'>
                                        <div class="col-1">
                                            <label class="col-sm-12 col-form-label"><Main>Data início</Main></label>
                                            <div class="input group">
                                                <input type="date" class="form-control" placeholder="Data início" aria-label="Data início" name="dt_ini" value="{{$filtros['dt_ini']}}">    
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <label class="col-sm-12 col-form-label">Data fim</label>
                                            <input type="date" class="form-control" placeholder="Data fim" aria-label="Data fim" name="dt_fim" value="{{$filtros['dt_fim']}}">
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="col-sm-12 col-form-label">Forma de pagamento</label>
                                            <select name="forma_pagamento_id" class="form-control">
                                                <option value="0">Todos</option>
                                                @forelse ($formaPagamentos as $formaPagamento )
                                                
                                                <option value="{{ $formaPagamento->id}}"
                                                    @if ($filtros['forma_pagamento_id'] && $filtros['forma_pagamento_id'] == $formaPagamento->id)
                                                        selected
                                                    @endif
                                                    >{{ $formaPagamento->descricao}}</option>
                                                
                                                @empty
                                                <p>Sem registros</p>
                                                
                                                @endforelse
                                            </select>
                                            
                                        </div>
                                        
                                        <div class="col-4">
                                            <label class="col-sm-12 col-form-label">Sub grupo</label>
                                            <select name="subgrupo_id" class="form-control">
                                                <option value="0">Todos</option>
                                                @forelse ($subgrupos as $subgrupo )
                                                
                                                <option value="{{ $subgrupo->id}}"
                                                    @if ($filtros['subgrupo_id'] && $filtros['subgrupo_id'] == $subgrupo->id)
                                                    selected
                                                @endif
                                                    >{{ $subgrupo->descricao}}</option>
                                                
                                                @empty
                                                <p>Sem registros</p>
                                                
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col-2 ">
                                            <button type="submit" class="btn btn-info">Filtrar</button>
                                        </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                            <h1 class="card-title">Lista de {{$infoPagina['titulo']}}:  
                                @dinheiro($subTotal['vlrAPagar']) | @dinheiro($subTotal['vlrTotal'])
                            </h1>
                            <div class="card-tools">
                                <form action="{{ route('lancamentos.filtros',['tipo' => $infoPagina['tipoRota'] ] ) }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="hidden" value="{{$infoPagina['tipoLancamento']}}" name='tipo_lancamento'>
                                    <input type="hidden" value="{{$filtros['subgrupo_id']}}" name='subgrupo_id'>
                                    <input type="hidden" value="{{$filtros['forma_pagamento_id']}}" name='forma_pagamento_id'>
                                    <input type="hidden" value="{{$filtros['dt_ini']}}" name='dt_ini'>
                                    <input type="hidden" value="{{$filtros['dt_fim']}}" name='dt_fim'>
                                    <input type="text" class="form-control float-right" placeholder="Search" name="lancamento" value="{{$filtros['lancamento']}}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Data Vencimento</th>
                                <th>Subgrupo</th>
                                <th>Descrição</th>
                                <th>Valor Total</th>
                                <th>Forma Pagamento</th>
                                <th>Parcela</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                            </thead>
                                <tbody>
                                    @forelse($lancamentos as $lancamento)
                                        <tr>
                                        <td>@dataBr($lancamento->dt_vencimento)</td>
                                        <td>{{$lancamento->subgrupo}}</td>
                                        <td>{{$lancamento->lancamento}}</td>
                                        <td>@dinheiro($lancamento->valor)</td>
                                        <td>{{$lancamento->formaPagamento}}</td>
                                        <td>{{$lancamento->parcela}}/{{$lancamento->total_parcelas}}</td>
                                        </td>
                                        @if ($lancamento->pago == 'S')
                                                <td><a class="btn btn-block btn-secondary" href="{{ route('lancamento.baixar', ['id' => $lancamento->id,'pago' =>0])}}"> <i class="fa fa-hand-holding-dollar"> Retorno</a></td>
                                                @else
                                                <td><a class="btn btn-block btn-success" href="{{ route('lancamento.baixar', ['id' => $lancamento->id,'pago' =>1])}}"> <i class="fa fa-money"></i> Baixar</a></td>
                                            @endif
                                        <td><a class="btn btn-block btn-warning" href="{{ route('lancamento.edit', [$lancamento->id])}}"> <i class="fa fa-edit"></i> Editar</a></td>
                                        <td>
                                            <form action="{{ route('lancamento.excluir',  $lancamento->id )}}" method="get">
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
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                        <h3 class="card-title">Novo {{$infoPagina['titulo']}}</h3>
                        </div>


                        <form class="form-horizontal" action="{{ route('lancamento.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    
                                    <div class="col-12">
                                        <input type="hidden" value="{{$infoPagina['tipoLancamento']}}" name='tipo_lancamento'>
                                        <label for="inputDescricao" class="col-sm-12 col-form-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" id="inputDescricao" placeholder="Descrição">
                                    </div>
                                    <div class="col-4">
                                        <label for="input_dt_compra" class="col-sm-12 col-form-label">Data Compra</label>
                                        <input type="date" name="dt_compra" class="form-control" id="input_dt_compra" >
                                    </div>
                                    <div class="col-4">
                                        <label for="input_valor" class="col-sm-12 col-form-label">Valor compra</label>
                                        <input type="numeric" name="valor" class="form-control" id="input_valor" >
                                    </div>
                                    <div class="col-4">
                                        <label for="input_total_parcelas" class="col-sm-12 col-form-label">Total parcelas</label>
                                        <input type="numeric" name="total_parcelas" class="form-control" id="input_total_parcelas" >
                                    </div>
                                    <div class="col-6">
                                        <label class="col-sm-12 col-form-label">Sub grupo</label>
                                        <select name="subgrupo_id" class="form-control">
                                            @forelse ($subgrupos as $subgrupo )
                                                
                                                <option value="{{ $subgrupo->id}}">{{ $subgrupo->descricao}}</option>
                                                
                                                @empty
                                                <p>Sem registros</p>
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="col-sm-12 col-form-label">Forma de pagamento</label>
                                        <select name="forma_pagamento_id" class="form-control">
                                            @forelse ($formaPagamentos as $formaPagamento )
                                            
                                            <option value="{{ $formaPagamento->id}}">{{ $formaPagamento->descricao}}</option>
                                            
                                            @empty
                                            <p>Sem registros</p>
                                            
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="input_obs" class="col-sm-12 col-form-label">Observações</label>
                                        <textarea type="text" name="obs" row=10 class="form-control" id="input_obs" ></textarea>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Salvar</button>
                                <button type="submit" class="btn btn-default float-right">Cancelar</button>
                            </div>
                            
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
  
    </div>
@stop