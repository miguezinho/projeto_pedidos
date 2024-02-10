<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pedido #{{ $pedido->id . " - " . $pedido->produto }}</h1>
            </div>
            <div class="col-sm-6">
                <a href="javascript:void(0)" class="btn btn-primary float-right btnNovaImagem"
                    data-href="{{ $pedido->id  }}">
                    <i class="nav-icon fas fa-plus mr-1"></i>
                    Nova Imagem
                </a>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        @include('pedidos_imagens.table')
    </div>
</div>

<script type="text/javascript">

    const scriptPedidoImagens = {

        fConfig: () => {

            $('#modalPedidosImagens .btnNovaImagem')
                .off('click').unbind('click')
                .on('click', function (e) {
                    let pedido_id = $(e.currentTarget).data('href');

                    $(e.currentTarget).append(`<div class="loading spinner-grow ml-2 spinner-grow-sm text-info" role="status"></div>`);
                    $.ajax({
                        method: "GET",
                        url: `{{ route('pedidos-imagens.create') }}?pedido_id=${pedido_id}`,
                        loading: true,
                        success: (data) => {
                            $(`.loading`).remove();
                            $('#modalPedidosImagens .modal-body').html(data);
                        }
                    });
                });

            $(document)
                //Cancelar
                .off('click', '#modalPedidosImagens .btnCancelarImagem').unbind('click', '#modalPedidosImagens .btnCancelarImagem')
                .on('click', '#modalPedidosImagens .btnCancelarImagem', function (e) {
                    let pedido_id = $(e.currentTarget).data('href');

                    $(e.currentTarget).append(`<div class="loading spinner-grow ml-2 spinner-grow-sm text-secondary" role="status"></div>`);
                    $.ajax({
                        method: "GET",
                        url: `{{ route('pedidos-imagens.index') }}?pedido_id=${pedido_id}`,
                        loading: true,
                        success: (data) => {
                            $(`.loading`).remove();
                            $('#modalPedidosImagens .modal-body').html(data);
                        }
                    });
                })

                //Salvar
                .off('click', '#modalPedidosImagens .btnSubmitSalvarImagem').unbind('click', '#modalPedidosImagens .btnSubmitSalvarImagem')
                .on('click', '#modalPedidosImagens .btnSubmitSalvarImagem', function (e) {
                    let pedido_id = $(e.currentTarget).data('href');
                    let formData = new FormData($("#formPedidosImagens")[0]);

                    $(e.currentTarget).append(`<div class="loading spinner-grow ml-2 spinner-grow-sm text-info" role="status"></div>`);
                    $.ajax({
                        method: "POST",
                        url: `{{ route('pedidos-imagens.store') }}`,
                        loading: true,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: (data) => {
                            $('#modalPedidosImagens .modal-body').html(data);
                        },
                        error: (err) => {
                            $('#modalPedidosImagens .modal-body').append(data);
                            console.log(err);

                            let message = "";

                            try {
                                let json = $.parseJSON(err.responseText);
                                console.log(json);

                                for (const property in json.errors) {
                                    message += `- ${json.errors[property]} <br/>`;
                                }
                            } catch (error) {
                                console.error(error);
                                message = "Erro desconhecido!"
                            }

                            Swal.fire("Erro!", message, "error")
                        },
                        complete: (data) => {
                            $(`.loading`).remove();
                        }
                    });
                });
        },

    }

    $(document).ready(function () {
        scriptPedidoImagens.fConfig();
    });
</script>
</div>