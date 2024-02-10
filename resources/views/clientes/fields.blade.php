<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control', '', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Cpf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cpf', 'CPF:') !!}
    {!! Form::text('cpf', null, ['class' => 'form-control', '', 'maxlength' => 15, 'maxlength' => 15]) !!}
</div>

<!-- Data Nasc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_nasc', 'Data Nasc:') !!}
    {!! Form::date('data_nasc', isset($clientes) ? $clientes->data_nasc->format("Y-m-d") : null, ['class' => 'form-control', 'id' => 'data_nasc', 'max' => date("Y-m-d")]) !!}
</div>

<!-- Telefone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control', 'maxlength' => 15, 'maxlength' => 15]) !!}
</div>

<!-- Ativo Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('ativo', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('ativo', '1', isset($clientes) ? $clientes->ativo : true, ['class' => 'form-check-input']) !!}
        {!! Form::label('ativo', 'Ativo', ['class' => 'form-check-label']) !!}
    </div>
</div>
