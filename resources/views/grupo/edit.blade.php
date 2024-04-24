@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{$infoPagina['titulo']}} </h1>
@stop

@section('content')
    @if((session('sucesso')))
        <div class="alert alert-success">
            {{ session('sucesso')}}
        </div>
    @endif
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Lista de {{$infoPagina['titulo']}} </h3>
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
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </thead>
                            <tbody>
                                @forelse($grupos as $grp)
                                    <tr>
                                    <td>{{$grp->id}}</td>
                                    <td>{{$grp->descricao}}</td>
                                    <td><a class="btn btn-block btn-warning" href="{{ route('grupo.edit', [$grp->id])}}"> <i class="fa fa-edit"></i> Editar</a></td>
                                    <td>
                                        <form action="{{ route('grupo.excluir',  $grp->id )}}" method="get">
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
                        <h3 class="card-title">Editar {{$infoPagina['titulo']}} </h3>
                        </div>


                        <form class="form-horizontal" action="{{ route('grupo.update', [$grupo->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-8">
                                        <input type="hidden" name="id" value="{{ $grupo->id }}">
                                        <label for="inputDescricao" class="col-sm-12 col-form-label">Descrição</label>
                                        <input type="text" name="descricao" class="form-control" id="inputDescricao" value="{{ $grupo->descricao }}">
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
