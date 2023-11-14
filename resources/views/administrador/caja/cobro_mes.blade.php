<form method="POST" id="form_guardar_servicio" autocomplete="off">
    @csrf
    <div class="text-center py-4" >
        <h6> {{ $gestion_lis->gestion }}</h6>
    </div>

    @php
        $fecha = new DateTime($registro_cobro->fecha);
        $ano = date('Y', $fecha->getTimestamp());
    @endphp


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
                                <th scope="col" class="table-th">MES</th>
                                <th scope="col" class="table-th">ESTADO</th>
                                <th scope="col" class="table-th">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$facturacion->isEmpty())
                                @foreach ($facturacion as $lis)
                                    @foreach ($mes_lis as $mes)
                                        @if ($mes->id == $lis->id_mes)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="flex items-center space-x-2 flex-wrap">
                                                        <div class="checkbox-area primary-checkbox">
                                                            <label class="inline-flex items-center cursor-pointer" for="{{ $mes->id }}">
                                                                <input type="checkbox" class="hidden" name="mes[]" id="{{ $mes->id }}" value="{{ $mes->id }}">
                                                                <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                    <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                                <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $mes->nombre_mes.'[ PAGADO ]' }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    estado
                                                </td>
                                                <td>
                                                    acciones
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="flex items-center space-x-2 flex-wrap">
                                                        <div class="checkbox-area primary-checkbox">
                                                            <label class="inline-flex items-center cursor-pointer" for="{{ $mes->id }}">
                                                                <input type="checkbox" class="hidden" name="mes[]" id="{{ $mes->id }}" value="{{ $mes->id }}">
                                                                <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                    <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                                <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $mes->nombre_mes }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    estado
                                                </td>
                                                <td>
                                                    acciones
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach
                                @endforeach
                            @else
                                @foreach ($mes_lis as $mes)
                                    @if ( $ano >= $gestion_lis->gestion   &&  $mes->numero_mes >= $registro_cobro->numero_mes)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="flex items-center space-x-2 flex-wrap">
                                                    <div class="checkbox-area primary-checkbox">
                                                        <label class="inline-flex items-center cursor-pointer" for="{{ $mes->id }}">
                                                            <input type="checkbox" class="hidden" name="mes[]" id="{{ $mes->id }}" value="{{ $mes->id }}">
                                                            <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                            <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $mes->nombre_mes. ' [ PAGADO ]' }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                estado
                                            </td>
                                            <td>
                                                acciones
                                            </td>
                                        </tr>
                                    @elseif ($gestion_lis->gestion > $ano)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="flex items-center space-x-2 flex-wrap">
                                                    <div class="checkbox-area primary-checkbox">
                                                        <label class="inline-flex items-center cursor-pointer" for="{{ $mes->id }}">
                                                            <input type="checkbox" class="hidden" name="mes[]" id="{{ $mes->id }}" value="{{ $mes->id }}">
                                                            <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                            <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $mes->nombre_mes }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                estado
                                            </td>
                                            <td>
                                                acciones
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</form>
