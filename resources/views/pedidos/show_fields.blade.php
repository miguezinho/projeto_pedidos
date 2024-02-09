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
    <p>{{ $pedidos->data }}</p>
</div>

<!-- Cliente Id Field -->
<div class="col-sm-12">
    {!! Form::label('cliente_id', 'Cliente Id:') !!}
    <p>{{ $pedidos->cliente_id }}</p>
</div>

<!-- Pedido Status Id Field -->
<div class="col-sm-12">
    {!! Form::label('pedido_status_id', 'Pedido Status Id:') !!}
    <p>{{ $pedidos->pedido_status_id }}</p>
</div>

<!-- Ativo Field -->
<div class="col-sm-12">
    {!! Form::label('ativo', 'Ativo:') !!}
    <p>{{ $pedidos->ativo }}</p>
</div>

