@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| INICIO')
@section('contenido_recaudaciones')
    <!-- end single card -->
    <div class="card py-4">
        {{-- <header class=" card-header">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, adipisci pariatur quisquam quidem velit, perspiciatis esse aspernatur, assumenda optio alias inventore blanditiis accusamus sunt! Totam consequatur vel quam repellendus odit!
        </header> --}}
        <div class="card-body px-6 pb-6">
            <div class="grid xl:grid-cols-2 grid-cols-1 gap-5">
                <div class="text-center">
                    <h4 class="card-title">Personas</h4>
                    <div id="pieChart"></div>
                </div>
                <div class="text-center">
                    <h4 class="card-title">Zonas</h4>
                    <div id="donutChart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single card -->
@endsection
