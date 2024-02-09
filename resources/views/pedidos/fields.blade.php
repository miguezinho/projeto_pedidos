<!-- Produto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produto', 'Produto:') !!}
    {!! Form::text('produto', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data', 'Data:') !!}
    {!! Form::text('data', null, ['class' => 'form-control','id'=>'data']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#data').datepicker()
    </script>
@endpush

<!-- Cliente Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cliente_id', 'Cliente Id:') !!}
    {!! Form::number('cliente_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Pedido Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pedido_status_id', 'Pedido Status Id:') !!}
    {!! Form::number('pedido_status_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Ativo Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('ativo', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('ativo', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('ativo', 'Ativo', ['class' => 'form-check-label']) !!}
    </div>
</div>