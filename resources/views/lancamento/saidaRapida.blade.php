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
        <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                        <h3 class="card-title">Nova {{$infoPagina['titulo']}}</h3>
                        </div>


                        <form class="form-horizontal" action="{{ route('lancamento.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" value="S" name='tipo_lancamento'>
                                        <label for="inputDescricao" class="col-sm-12 col-form-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" id="inputDescricao" placeholder="Descrição">
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                        <label for="input_valor" class="col-sm-12 col-form-label">Valor compra</label>
                                        <input type="number" step=0.01 name="valor" class="form-control" id="input_valor" >
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <label class="col-sm-12 col-form-label">Forma de pagamento</label>
                                        <select name="forma_pagamento_id" class="form-control">
                                            @forelse ($formaPagamentos as $formaPagamento )
                                            
                                            <option value="{{ $formaPagamento->id}}">{{ $formaPagamento->descricao}}</option>
                                            
                                            @empty
                                            <p>Sem registros</p>
                                            
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-xl-6">
                                        <label class="col-sm-12 col-form-label">Sub grupo</label>
                                        <select name="subgrupo_id" class="form-control">
                                            @forelse ($subgrupos as $subgrupo )
                                                
                                                <option value="{{ $subgrupo->id}}"
                                                    @if ($infoPagina['idSaidaRapida'] == $subgrupo->id )
                                                        selected
                                                    @endif
                                                    
                                                    
                                                    >{{ $subgrupo->descricao}}</option>
                                                
                                                @empty
                                                <p>Sem registros</p>
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                  
                                    <div class="col-6 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                        <label for="input_dt_compra" class="col-sm-12 col-form-label">Data Compra</label>
                                        <input type="date" name="dt_compra" class="form-control" id="input_dt_compra" value="{{$infoPagina['data']}}" >
                                    </div>
                                    <div class="col-6 col-lg-4 col-md-12 col-xs-12 col-sm-12">
                                        <label for="input_total_parcelas" class="col-sm-12 col-form-label">Total parcelas</label>
                                        <input type="number" step=0.01 name="total_parcelas" class="form-control" id="input_total_parcelas" value='1' >
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
