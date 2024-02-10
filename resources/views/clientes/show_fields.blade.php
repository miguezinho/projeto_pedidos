<!-- Nome Field -->
<div class="col-sm-12">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{{ $clientes->nome }}</p>
</div>

<!-- Cpf Field -->
<div class="col-sm-12">
    {!! Form::label('cpf', 'Cpf:') !!}
    <p>{{ $clientes->cpf }}</p>
</div>

<!-- Data Nasc Field -->
<div class="col-sm-12">
    {!! Form::label('data_nasc', 'Data Nasc:') !!}
    <p>{{ $clientes->data_nasc->format("d/m/Y") }}</p>
</div>

<!-- Telefone Field -->
<div class="col-sm-12">
    {!! Form::label('telefone', 'Telefone:') !!}
    <p>{{ $clientes->telefone }}</p>
</div>

<!-- Ativo Field -->
<div class="col-sm-12">
    {!! Form::label('ativo', 'Ativo:') !!}
    <p>{{ $clientes->ativo == 1 ? "Sim" : "Não" }}</p>
</div>

