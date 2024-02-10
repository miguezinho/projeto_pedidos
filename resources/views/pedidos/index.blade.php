@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pedidos</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('pedidos.create') }}">
                       <i class="nav-icon fas fa-cart-plus"></i>
                        Novo pedido
                    </a>
                    <a class="btn btn-default float-right mr-4"
                       href="{{ route('pedidos.create') }}">
                       <i class="nav-icon fas fa-file-csv"></i>
                        Exportar CSV
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            @include('pedidos.table')
        </div>
    </div>

@endsection
