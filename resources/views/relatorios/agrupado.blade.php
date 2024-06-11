@extends('adminlte::page')

@section('title', 'Financeiro')

@section('content_header')
  
@stop

@section('content')
@include('forms.filtros')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                            <h1 class="card-title ">Lista de {{$infoPagina['titulo']}} </h1>
                        </div>

                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-sm  text-truncate datatables">
                        <thead>
                            <tr>
                                <th>Subgrupo</th>
                                <th>Valor Total</th>
                            </tr>
                            </thead>
                                <tbody>
                                    @forelse($lancamentos as $lancamento)
                                        <tr>
                                            <td>{{$lancamento->subgrupo}}</td>
                                            <td>@dinheiro($lancamento->valor_total)</td>
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
    </div>
@stop
