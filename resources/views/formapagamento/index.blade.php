@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
{{ Breadcrumbs::render('formaPagamento') }}
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
                        <h3 class="card-title">Editar / Novo</h3>
                        </div>


                        <form class="form-horizontal" action="{{ route('formadepagamento.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-xs-12 col-lg-8">
                                        <label for="inputDescricao" class="col-sm-12 col-form-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" id="inputDescricao" placeholder="Descrição">
                                    </div>
                                    <div class="col-xs-12 col-lg-2">
                                        <label for="inputCompra" class="col-sm-12 col-form-label">Dia para Compra</label>
                                        <input type="number" name="diacompra" class="form-control" id="inputCompra" >
                                    </div>
                                    <div class="col-xs-12 col-lg-2">
                                        <label for="inputVencimento" class="col-sm-12 col-form-label">Vencimento</label>
                                        <input type="number" name="diavencimento" class="form-control" id="inputVencimento" >
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
