
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    Cadastro de imagens do pedido #{{ $pedido->id . " - " . $pedido->produto }}
                </h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::open(['route' => 'pedidos-imagens.store', 'onsubmit' => 'return false;', 'id' => 'formPedidosImagens']) !!}

        <div class="card-body">

            <div class="row">
                @include('pedidos_imagens.fields')
            </div>

        </div>

        <div class="card-footer">
            {!! Form::button('Salvar', ['class' => 'btn btn-primary btnSubmitSalvarImagem', 'data-href' => $pedido->id ]) !!}
            <a href="javascript:void(0)" data-href="{{ $pedido->id }}" class="btn btn-default btnCancelarImagem"> Cancelar </a>
        </div>

        {!! Form::close() !!}

    </div>
</div>