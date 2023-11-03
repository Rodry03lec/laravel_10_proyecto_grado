@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| PERSONAL')
@section('contenido_recaudaciones')

    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                <a href="{{ route('recaudaciones') }}">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                </a>
            </li>
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                Personal trabajo
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">personal</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Listado de unidades </h4>
            </header>
        </div>
    </div>

    <div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5">
        @foreach ($listar_unidad as $lis)
            <div class="card">
                <div class="card-body">
                    <div class="card-text h-full">
                        <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500">
                        <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500" icon="fluent:virtual-network-toolbox-20-filled"></iconify-icon>
                        <h3 class="card-title mb-0 text-primary-500">{{ $lis->nombre }}</h3>
                        </header>
                        <div class="py-3 px-5">
                            <h5 class="card-subtitle">{{ $lis->descripcion }}</h5>
                        </div>
                        <div class="text-center py-2 px-5">
                            <a href="{{ route('petr_listar', ['id'=>encriptar($lis->id)]) }}" class="btn inline-flex justify-center btn-dark">
                                <span class="flex items-center">
                                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:newspaper"></iconify-icon>
                                    <span>Ingresar</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

