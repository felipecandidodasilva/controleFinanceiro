<div class="row">
    <div class="col">
        <div class="card"> 
            <div class="card-body">
                <div class="card card-info">
                    <form action="{{ route('lancamentos.filtros',['tipo' => $infoPagina['tipoRota'] ] ) }}" method="get" class="">
                        <div class="card-body table-responsive p-2">
                            <div class="row" >
                                    @csrf
                                    <input type="hidden" value="{{$infoPagina['tipoLancamento']}}" name='tipo_lancamento'>
                                        <div class="col-md-6 col-xl-1">
                                            <label for="dt_ini"><Main>Data início</Main></label>
                                            <input type="date" class="form-control" placeholder="Data início" aria-label="Data início" name="dt_ini" value="{{$filtros['dt_ini']}}">    
                                        </div>
                                        <div class="col-md-6 col-xl-1">
                                            <label for="dt_fim">Data fim</label>
                                            <input type="date" class="form-control" placeholder="Data fim" aria-label="Data fim" name="dt_fim" value="{{$filtros['dt_fim']}}">
                                        </div>
                                    
                                    <div class="col-md-5 col-xl-4">
                                        <label class="">Forma de pagamento</label>
                                        <select name="forma_pagamento_id" class="form-control">
                                            <option value="0">Todos</option>
                                            @forelse ($formaPagamentos as $formaPagamento )
                                            
                                            <option value="{{ $formaPagamento->id}}"
                                                @if ($filtros['forma_pagamento_id'] && $filtros['forma_pagamento_id'] == $formaPagamento->id)
                                                    selected
                                                @endif
                                                > {{ $formaPagamento->id}} - {{ $formaPagamento->descricao}}</option>
                                            
                                            @empty
                                            <p>Sem registros</p>
                                            
                                            @endforelse
                                        </select>
                                        
                                    </div>
                                    
                                    <div class="col-md-5 col-xl-4">
                                        <label class="">Sub grupo</label>
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
                                        
                                        <div class="col-2 col-md-2">
                                        <label class="">.</label>
                                        <button type="submit" class="btn btn-info form-control">Filtrar</button>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>