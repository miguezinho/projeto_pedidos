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
                    <td style="width: 120px" class="tdAction{{ $pedido->id }}">
                        {!! Form::open(['route' => ['pedidos.destroy', $pedido->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('pedidos.show', [$pedido->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="javascript:void(0)" title="Imagens" alt="Imagens" data-href="{{ $pedido->id }}"
                                class='btn btn-default btn-xs btnPedidosImagens'>
                                <i class="far fa-image"></i>
                            </a>
                            <a href="{{ route('pedidos.edit', [$pedido->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn
                            btn-danger btn-xs', 'onclick' => "return confirm('Tem certeza que deseja deletar o
                            pedido?')"]) !!}
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

@push('page_scripts')
<script type="text/javascript">

    $(document)
        .off('click', '.btnPedidosImagens').on('click', '.btnPedidosImagens', function (e) {
            let pedido_id = $(e.currentTarget).data('href');

            $(`.tdAction${pedido_id}`).append(`<div class="text-center loading"><div class="spinner-grow spinner-grow-sm text-secondary" role="status"></div></div>`);
            $.ajax({
                method: "GET",
                url: `{{ route('pedidos-imagens.index') }}?pedido_id=${pedido_id}`,
                loading: true,
                success: (data) => {
                    $(`.loading`).remove();

                    let html_modal =
                        `<div class="modal" id="modalPedidosImagens" style="display: block; padding-right: 17px;" aria-modal="true" role="dialog">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Imagens</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"></div>
                                </div>
                            </div>
                        </div>`;

                    $('body').append(html_modal);
                    $('.modal-body').html(data);
                }
            });
        })
        .on('click', '.modal .close', function (e) {
            $(e.currentTarget).closest('.modal').remove();
        });

</script>
@endpush