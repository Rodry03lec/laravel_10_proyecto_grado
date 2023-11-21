<form id="form_mensual_pagar" method="post" autocomplete="off">
    @csrf
    <input type="hidden" id="id_gestion_mes" name="id_gestion_mes" value="{{ $gestion->id }}">
    <input type="hidden" id="id_registro_cobros_mes" name="id_registro_cobros_mes" value="{{ $id_registro_c }}">
</form>

<div class="card-body px-6 pb-6">
    <div class="flex flex-wrap justify-between items-center mb-4">
        <header class="card-header noborder">
            <div class="card-title text-slate-500 dark:text-white">GESTIÓN : {{ $gestion->gestion }}</div>
        </header>
        <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse " id="mostrar_precio_cobrando">
            <button class="btn relative inline-flex justify-center btn-dark">Seleccionados Bs. 0.00
                <span class="w-5 h-5 inline-flex items-center justify-center bg-danger-500 text-white rounded-full font-Inter text-xs absolute -top-[5px] -right-1">0</span>
            </button>
        </div>
    </div>
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
                            <th scope="col" class="table-th">MES</th>
                            <th scope="col" class="table-th">MONTO</th>
                            <th scope="col" class="table-th">MARCAR</th>
                            <th scope="col" class="table-th">ESTADO</th>
                            <th scope="col" class="table-th">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $anio_registrado    = date('Y', strtotime($registro_cobros->fecha));
                            $mes_registrado     = $registro_cobros->numero_mes;
                            $monto_total        = 0;
                        @endphp



                        @foreach ($resultados as $resultado)
                            @if ($anio_registrado==$gestion->gestion)
                                @if ($resultado['mes']->numero_mes >= $mes_registrado)
                                    <tr>
                                        <td class="table-td">{{ $loop->iteration }}</td>
                                        <td class="table-td">{{ $resultado['mes']->nombre_mes }}</td>
                                        <td class="table-td">{{ con_separador_comas($registro_cobros->instalacion->sub_categoria->precio_fijo).' Bs' }}</td>
                                        <td class="table-td">
                                            @if (!$resultado['factura_consulta']->isEmpty())
                                                <div class="flex items-center space-x-2 flex-wrap">
                                                    <div class="checkbox-area primary-checkbox">
                                                        <label class="inline-flex items-center cursor-pointer" for="{{ $resultado['mes']->id }}">
                                                            <input type="checkbox" class="hidden" name="mes[]" id="{{ $resultado['mes']->id }}" value="{{ $resultado['mes']->id }}" checked disabled readonly>
                                                            <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-center space-x-2 flex-wrap">
                                                    <div class="checkbox-area primary-checkbox">
                                                        <label class="inline-flex items-center cursor-pointer" for="{{ $resultado['mes']->id }}">
                                                            <input type="checkbox" class="hidden" name="mes[]" id="{{ $resultado['mes']->id }}" value="{{ $resultado['mes']->id }}" onclick="handleCheckboxClick(this, '{{ $registro_cobros->instalacion->sub_categoria->precio_fijo }}')">
                                                            <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        @if (!$resultado['factura_consulta']->isEmpty())
                                            <td class="table-td">
                                                <span class="badge bg-success-500 text-white capitalize pill">Pagado</span>
                                            </td>
                                            <td class="table-td">
                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                    <a href="{{ route('pdf_comprobante_mensual', ['id'=>encriptar($resultado['factura_consulta'][0]->id)]) }}" class="action-btn btn-danger" target="_blank">
                                                    <iconify-icon icon="heroicons-outline:document-text"></iconify-icon>
                                                    </a>
                                                </div>
                                            </td>
                                            @php
                                                $monto_total = $monto_total + $resultado['factura_consulta'][0]->caja_detalle->importe;
                                            @endphp
                                        @else
                                            <td class="table-td">
                                                <span class="badge bg-danger-500 text-white capitalize pill">Pendiente</span>
                                            </td>
                                            <td class="table-td">
                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                    <button class="action-btn btn-success" onclick="realizar_pago_mensual('{{ $resultado['mes']->id }}', '{{ $gestion->id }}', '{{ $id_registro_c }}')" type="button">
                                                    <iconify-icon icon="heroicons-outline:currency-dollar"></iconify-icon>
                                                    </button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="table-td">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ $resultado['mes']->nombre_mes }}</td>
                                    <td class="table-td">{{ con_separador_comas($registro_cobros->instalacion->sub_categoria->precio_fijo).' Bs' }}</td>
                                    <td class="table-td">
                                        @if (!$resultado['factura_consulta']->isEmpty())
                                            <div class="flex items-center space-x-2 flex-wrap">
                                                <div class="checkbox-area primary-checkbox">
                                                    <label class="inline-flex items-center cursor-pointer" for="{{ $resultado['mes']->id }}">
                                                        <input type="checkbox" class="hidden" name="mes[]" id="{{ $resultado['mes']->id }}" value="{{ $resultado['mes']->id }}" checked disabled readonly>
                                                        <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                            <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex items-center space-x-2 flex-wrap">
                                                <div class="checkbox-area primary-checkbox">
                                                    <label class="inline-flex items-center cursor-pointer" for="{{ $resultado['mes']->id }}">
                                                        <input type="checkbox" class="hidden" name="mes[]" id="{{ $resultado['mes']->id }}" value="{{ $resultado['mes']->id }}" onclick="handleCheckboxClick(this, '{{ $registro_cobros->instalacion->sub_categoria->precio_fijo }}')">
                                                        <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                            <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    </td>


                                    @if (!$resultado['factura_consulta']->isEmpty())
                                        <td class="table-td">
                                            <span class="badge bg-success-500 text-white capitalize pill">Pagado</span>
                                        </td>
                                        <td class="table-td">
                                            {{-- {{ $resultado['factura_consulta'][0]->id }} --}}
                                            <div class="flex space-x-3 rtl:space-x-reverse">
                                                <a href="{{ route('pdf_comprobante_mensual', ['id'=>encriptar($resultado['factura_consulta'][0]->id)]) }}" class="action-btn btn-danger" target="_blank">
                                                <iconify-icon icon="heroicons-outline:document-text"></iconify-icon>
                                                </a>
                                            </div>
                                        </td>
                                        @php
                                            $monto_total = $monto_total + $resultado['factura_consulta'][0]->caja_detalle->importe;
                                        @endphp
                                    @else
                                        <td class="table-td">
                                            <span class="badge bg-danger-500 text-white capitalize pill">Pendiente</span>
                                        </td>
                                        <td class="table-td">
                                            <div class="flex space-x-3 rtl:space-x-reverse">
                                                <button class="action-btn btn-success" onclick="realizar_pago_mensual('{{ $resultado['mes']->id }}', '{{ $gestion->id }}', '{{ $id_registro_c }}', '{{ obtenerNombreMes($resultado['mes']->numero_mes) }}')" type="button">
                                                <iconify-icon icon="heroicons-outline:currency-dollar"></iconify-icon>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot class=" bg-slate-200 dark:bg-slate-700 ">
                        <tr>
                            <td scope="col" class="table-th">Total cancelado</td>
                            <td scope="col" class="table-th" colspan="2" > {{ con_separador_comas($monto_total).' Bs ('.convertir($monto_total).')' }} </td>
                            <td scope="col" class="table-th">Monto faltante</td>
                            <td scope="col" class="table-th" colspan="2" >{{ con_separador_comas($monto_total_anual-$monto_total).' Bs ('.convertir($monto_total_anual-$monto_total).')' }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
