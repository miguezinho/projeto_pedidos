<!-- Pedido Id Field -->
{!! Form::hidden('pedido_id', $pedido->id) !!}

<!-- Imagem Field -->
<div class="form-group col-sm-12">
    {!! Form::label('imagem', 'Imagem:') !!}
    {!! Form::file('imagem', null, ['class' => 'form-control', '', 'maxlength' => 255, 'maxlength' => 255, 'accept' => 'image/png, image/jpeg']) !!}
</div>
