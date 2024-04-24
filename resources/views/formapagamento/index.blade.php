@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    @if((session('sucesso')))
        <div class="alert alert-success">
            {{ session('sucesso')}}
        </div>
    @if((session('falha')))
        <div class="alert alert-danger">
            {{ session('falha')}}
        </div>
    @endif
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formas de Pagamento</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                            </button>
                            </div>
                            </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Dia Compra</th>
                        <th>Dia Vencimento</th>
                        <th>#</th>
                        <th>#</th>
                        </tr>
                            </thead>
                                <tbody>
                                    @forelse($formasDePagamento as $formaPgt)
                                        <tr>
                                        <td>{{$formaPgt->id}}</td>
                                        <td>{{$formaPgt->descricao}}</td>
                                        <td>{{$formaPgt->diacompra}}</td>
                                        <td>{{$formaPgt->diavencimento}}</td>
                                        </td>
                                        <td><a class="btn btn-block btn-warning" href="{{ route('formadepagamento.edit', [$formaPgt->id])}}"> <i class="fa fa-edit"></i> Editar</a></td>
                                        <td>
                                            <form action="{{ route('formadepagamento.excluir',  $formaPgt->id )}}" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-block btn-danger">Excluir</button>
                                            </form>
                                        </td>
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
        <div class="col-6">
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

                                    <div class="col-8">
                                        <label for="inputDescricao" class="col-sm-12 col-form-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" id="inputDescricao" placeholder="Descrição">
                                    </div>
                                    <div class="col-2">
                                        <label for="inputCompra" class="col-sm-12 col-form-label">Dia para Compra</label>
                                        <input type="number" name="diacompra" class="form-control" id="inputCompra" >
                                    </div>
                                    <div class="col-2">
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
