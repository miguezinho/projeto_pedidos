<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="pedidos-table">
            <thead>
            <tr>
                <th>Produto</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Status</th>
                <th>Ativo</th>
                <th colspan="3">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->produto }}</td>
                    <td>{{ $pedido->valor }}</td>
                    <td>{{ $pedido->data->format("d/m/Y") }}</td>
                    <td>{{ $pedido->Cliente->nome }}</td>
                    <td>{{ $pedido->PedidoStatus->descricao }}</td>
                    <td>{{ $pedido->ativo == 1 ? "Sim" : "Não" }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['pedidos.destroy', $pedido->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('pedidos.show', [$pedido->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('pedidos.edit', [$pedido->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza que deseja deletar o pedido?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $pedidos])
        </div>
    </div>
</div>
