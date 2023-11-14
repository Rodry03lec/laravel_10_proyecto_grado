@extends('menu.principal_caja')
@section('titulo_caja', '| INICIO')
@section('contenido_caja')
    <!-- end single card -->
    <div class="card py-4">
        <div class="card-body px-6 pb-6">
            <div class="grid xl:grid-cols-2 grid-cols-1 gap-5">
                <div class="text-center">
                    <h4 class="card-title">Personas</h4>
                    <div id="pieChart"></div>
                </div>
                <div class="text-center">
                    <h4 class="card-title">Cobros</h4>
                    <div id="donutChart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single card -->
@endsection
