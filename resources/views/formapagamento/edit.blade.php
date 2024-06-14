@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
    {{ Breadcrumbs::render('formaPagamento.editar',$formaPgto->descricao ) }}
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
        <div class="col-xs-12 col-lg-6">
            @include('formapagamento.lista')
        </div>
        <div class="col-xs-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                        <h3 class="card-title">Editar</h3>
                        </div>


                        <form class="form-horizontal" action="{{ route('formadepagamento.update', [$formaPgto->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-xs-12 col-lg-6">
                                        <input type="hidden" name="id" value="{{ $formaPgto->id }}">
                                        <label for="inputDescricao" class="col-sm-12 col-form-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" id="inputDescricao" value="{{ $formaPgto->descricao }}">
                                    </div>
                                    <div class="col-xs-12 col-lg-2">
                                        <label for="inputCompra" class="col-sm-12 col-form-label">Dia Compra</label>
                                        <input type="number" name="diacompra" class="form-control" id="inputCompra" value="{{ $formaPgto->diacompra }}">
                                    </div>
                                    <div class="col-xs-12 col-lg-2">
                                        <label for="inputVencimento" class="col-sm-12 col-form-label">Vencimento</label>
                                        <input type="number" name="diavencimento" class="form-control" id="inputVencimento" value="{{ $formaPgto->diavencimento }}">
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <label for="ativo" class="col-form-label">Situação</label>
                                        <select class="form-control" name="ativo" id="ativo" required>
                                                <option value="1"
                                                    @if ($formaPgto->ativo == 1 )
                                                        selected
                                                    @endif
                                                    >
                                                    Ativo
                                                </option>
                                                <option value="0"
                                                    @if ($formaPgto->ativo == 0 )
                                                        selected
                                                    @endif
                                                    >
                                                    Desativado
                                                </option>
                                                
                                        </select>
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
