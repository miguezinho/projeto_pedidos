<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Cpf Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cpf', 'Cpf:') !!}
    {!! Form::text('cpf', null, ['class' => 'form-control', 'required', 'maxlength' => 15, 'maxlength' => 15]) !!}
</div>

<!-- Data Nasc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_nasc', 'Data Nasc:') !!}
    {!! Form::text('data_nasc', null, ['class' => 'form-control','id'=>'data_nasc']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#data_nasc').datepicker()
    </script>
@endpush

<!-- Telefone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control', 'maxlength' => 15, 'maxlength' => 15]) !!}
</div>

<!-- Ativo Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('ativo', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('ativo', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('ativo', 'Ativo', ['class' => 'form-check-label']) !!}
    </div>
</div>