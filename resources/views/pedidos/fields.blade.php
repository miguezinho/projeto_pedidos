<!-- Cliente Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('cliente_id', 'Cliente:') !!}
    {!! Form::select('cliente_id', $clientes, old('cliente_id'), ['class' => 'form-control', '']) !!}
</div>

<!-- Produto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produto', 'Produto:') !!}
    {!! Form::text('produto', null, ['class' => 'form-control', '', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control', '']) !!}
</div>

<!-- Data Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data', 'Data:') !!}
    {!! Form::date('data', isset($pedidos) ? $pedidos->data->format("Y-m-d") : null, ['class' =>
    'form-control','id'=>'data']) !!}
</div>

<!-- Pedido Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pedido_status_id', 'Status:') !!}
    {!! Form::select('pedido_status_id', $pedido_status, old('pedido_status_id'), ['class' => 'form-control',
    'required']) !!}
</div>

<!-- Ativo Field -->
<div class="form-group col-sm-12">
    <div class="form-check">
        {!! Form::hidden('ativo', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('ativo', '1', isset($pedidos) ? $pedidos->ativo : true, ['class' => 'form-check-input']) !!}
        {!! Form::label('ativo', 'Ativo', ['class' => 'form-check-label']) !!}
    </div>
</div>

<style>
    .select2-selection__rendered {
        line-height: 37px !important;
    }

    .select2-container .select2-selection--single {
        height: 37px !important;
    }

    .select2-selection__arrow {
        height: 37px !important;
    }
</style>

@push('page_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('#cliente_id').select2({
        placeholder: "Select",
        allowClear: true,
        width: "100%"
    });
</script>
@endpush