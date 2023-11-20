    <div class="flex-1 text-center">
        <div class="card-title text-slate-500 dark:text-white">GESTIÓN : {{ $gestion_anual->gestion }}</div>
    </div>

@if ($existe_no == 1 && $pagar_no == 1)
    <div class="grid xl:grid-cols-1 md:grid-cols-41 sm:grid-cols-1 grid-cols-1 gap-5 text-center py-5">
        <div class="flex-1">
            <div class="card-title text-slate-500 dark:text-white">DATOS PARA EL RECIBO PROVISIONAL</div>
        </div>

        <form  method="post" id="formulario_pagar_anualmente" autocomplete="off">
            @csrf
            <input type="hidden" name="id_registro_cobros" value="{{ $id_registro_cobros }}">
            <input type="hidden" name="id_gestion_cobros" value="{{ $id_gestion_cobros }}">
            <input type="hidden" name="monto_mensual_cobros" value="{{ $monto_pagar_mensual }}">
            <input type="hidden" name="id_instalacion_cobros" value="{{ $id_instalacion_cobros }}">
        </form>

        <table class="table">
            <tr>
                <th>Estado</th>
                <td>
                    <div class="py-[18px] px-6 font-normal text-sm rounded-md bg-white text-success-500 border border-success-500 dark:bg-slate-800">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <iconify-icon class="text-2xl flex-0" icon="system-uicons:check-circle-outside"></iconify-icon>
                                <p class="flex-1 font-Inter">
                                    {{ $mensaje }}
                                </p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Monto a pagar mensualmente : </th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $monto_pagar_mensual . ' Bs' }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Monto total anual:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $monto_pagar_anual . ' Bs' }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>


@else
    <div class="py-[18px] px-6 font-normal text-sm rounded-md bg-white text-danger-500 border border-danger-500 dark:bg-slate-800">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <iconify-icon class="text-2xl flex-0" icon="system-uicons:cross-circle"></iconify-icon>
            <p class="flex-1 font-Inter">
                {{ $mensaje }}
            </p>
        </div>
    </div>



    @if ($listar_facturacion != null)
        <div class="card-body px-6 pb-6">
            <div class="overflow-x-auto -mx-2 dashcode-data-table">
                <span class=" col-span-8  hidden"></span>
                <span class="  col-span-4 hidden"></span>
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                            style="width: 100%">
                            <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                <tr>
                                    <th scope="col" class="table-th">ID</th>
                                    <th scope="col" class="table-th">Nº COMPROBANTE</th>
                                    <th scope="col" class="table-th">FECHA</th>
                                    <th scope="col" class="table-th">MES</th>
                                    <th scope="col" class="table-th">MONTO CANCELADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $suma_total = 0;
                                @endphp
                                @foreach ($listar_facturacion as $lis)
                                    <tr>
                                        <td class="table-td">{{ $loop->iteration }}</td>
                                        <td class="table-td">{{ $lis->numero_factura }}</td>
                                        <td class="table-td">{{ $lis->fecha }}</td>
                                        <td class="table-td">{{ $lis->mes->nombre_mes }}</td>
                                        <td class="table-td">{{ con_separador_comas($lis->caja_detalle->monto_ingreso). ' Bs ' }}</td>
                                    </tr>
                                    @php
                                        $suma_total = $suma_total + $lis->caja_detalle->monto_ingreso;
                                    @endphp
                                @endforeach
                            </tbody>
                            <thead class=" bg-slate-200 dark:bg-slate-700">
                                <tr >
                                    <th colspan="4" class="table-th" style="text-align: center;">TOTAL..</th>
                                    <th scope="col" class="table-th">{{ con_separador_comas($suma_total). ' Bs' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endif
