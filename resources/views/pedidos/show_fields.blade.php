<!-- Produto Field -->
<div class="col-sm-12">
    {!! Form::label('produto', 'Produto:') !!}
    <p>{{ $pedidos->produto }}</p>
</div>

<!-- Valor Field -->
<div class="col-sm-12">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{{ $pedidos->valor }}</p>
</div>

<!-- Data Field -->
<div class="col-sm-12">
    {!! Form::label('data', 'Data:') !!}
    <p>{{ $pedidos->data->format("d/m/Y") }}</p>
</div>

<!-- Cliente Id Field -->
<div class="col-sm-12">
    {!! Form::label('cliente_id', 'Cliente:') !!}
    <p>{{ $pedidos->Cliente->nome }}</p>
</div>

<!-- Pedido Status Id Field -->
<div class="col-sm-12">
    {!! Form::label('pedido_status_id', 'Status:') !!}
    <p>{{ $pedidos->PedidoStatus->descricao }}</p>
</div>

<!-- Ativo Field -->
<div class="col-sm-12">
    {!! Form::label('ativo', 'Ativo:') !!}
    <p>{{ $pedidos->ativo == 1 ? "Sim" : "Não" }}</p>
</div>

