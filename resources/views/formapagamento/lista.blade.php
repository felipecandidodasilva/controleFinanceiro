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
            <th>Situação</th>
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
                            @if ($formaPgt->ativo)
                                <td> Ativo</td>
                            @else
                                <td>Desativado</td>
                            @endif
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