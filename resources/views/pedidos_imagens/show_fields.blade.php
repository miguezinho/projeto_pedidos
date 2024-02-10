<!-- Pedido Id Field -->
<div class="col-sm-12">
    {!! Form::label('pedido_id', 'Pedido Id:') !!}
    <p>{{ $pedidosImagens->pedido_id }}</p>
</div>

<!-- Imagem Field -->
<div class="col-sm-12">
    {!! Form::label('imagem', 'Imagem:') !!}
    <p>{{ $pedidosImagens->imagem }}</p>
</div>

<!-- Capa Field -->
<div class="col-sm-12">
    {!! Form::label('capa', 'Capa:') !!}
    <p>{{ $pedidosImagens->capa }}</p>
</div>

