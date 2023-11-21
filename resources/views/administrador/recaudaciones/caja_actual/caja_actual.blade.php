@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| CAJA ACTUAL')
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
            Caja actual
        </li>
    </ul>
</div>

<div class="grid xl:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-5 py-4">
    <div class="card">
        <div class="card-body">
            <div class="card-text h-full ">
                <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500 ">
                    <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500"
                        icon="material-symbols-light:attach-money-rounded"></iconify-icon>
                    <h3 class="card-title mb-0 text-primary-500 ">Monto total en caja</h3>
                </header>
                <div class="py-3 px-5 text-center">
                    <h5 class="card-title">{{ con_separador_comas($total_caja).' Bs' }}</h5>
                    <p class="card-text mt-3">
                        {{ convertir($total_caja) }}
                    </p>
                </div>
                <div class="py-3 px-5 text-center">
                    <footer>
                        <a href="#" class="btn flex justify-center bg-slate-900 text-slate-50 dark:bg-slate-900 dark:text-slate-300">Imprimir detalle</a>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-text h-full ">
                <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500 ">
                    <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500"
                        icon="material-symbols-light:attach-money-rounded"></iconify-icon>
                    <h3 class="card-title mb-0 text-primary-500 ">Monto por la instalacion del servicio</h3>
                </header>
                <div class="py-3 px-5 text-center">
                    <h5 class="card-title">{{ con_separador_comas($total_caja_instalacion).' Bs' }}</h5>
                    <p class="card-text mt-3">
                        {{ convertir($total_caja_instalacion) }}
                    </p>
                </div>
                <div class="py-3 px-5 text-center">
                    <footer>
                        <a href="#" class="btn flex justify-center bg-slate-900 text-slate-50 dark:bg-slate-900 dark:text-slate-300">Imprimir detalle</a>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-text h-full ">
                <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500 ">
                    <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500"
                        icon="material-symbols-light:attach-money-rounded"></iconify-icon>
                    <h3 class="card-title mb-0 text-primary-500 ">Monto por cobro del servicio</h3>
                </header>
                <div class="py-3 px-5 text-center">
                    <h5 class="card-title">{{ con_separador_comas($total_caja_servicio).' Bs' }}</h5>
                    <p class="card-text mt-3">
                        {{ convertir($total_caja_servicio) }}
                    </p>
                </div>
                <div class="py-3 px-5 text-center">
                    <footer>
                        <a href="#" class="btn flex justify-center bg-slate-900 text-slate-50 dark:bg-slate-900 dark:text-slate-300">Imprimir detalle</a>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card py-4">
    <div class="card-body px-6 pb-6">

    </div>
</div> --}}
@endsection
