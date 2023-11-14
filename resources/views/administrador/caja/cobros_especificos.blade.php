@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| COBROS ESPECIFICOS')
@section('contenido_recaudaciones')
    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                <a href="#">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                </a>
            </li>
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                Corbos especificos
            </li>
        </ul>
    </div>

    <div class="grid xl:grid-cols-1 md:grid-cols-1 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-body">
                <div class="card-text h-full">
                    <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500">
                        <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500" icon="fluent:money-hand-24-filled"></iconify-icon>
                        <h3 class="card-title mb-0 text-primary-500">Cobros especificos</h3>
                    </header>
                    <div class="card-body px-6 pb-6">
                        <fieldset>
                            <legend>DATOS  -  @if ($instalacion->id_persona_juridica != null && $instalacion->id_persona_juridica != '') JURÍDICA @else NATURAL @endif </legend>
                            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
                                <table class="table">
                                    <tr>
                                        <th>CI - NOMBRES Y APELLIDOS : </th>
                                        <td>
                                            <div class="alert alert-outline-dark">
                                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                                    <div class="flex-1 font-Inter">
                                                        @if ($persona->complemento != null && $persona->complemento != '')
                                                            {{ $persona->ci.' - '.$persona->complemento.' '.$persona->expedido->sigla.' [ '.$persona->nombres.' '.$persona->apellido_paterno.' '.$persona->apellido_paterno.' ]'  }}
                                                        @else
                                                            {{ $persona->ci.' '.$persona->expedido->sigla.' [ '.$persona->nombres.' '.$persona->apellido_paterno.' '.$persona->apellido_paterno.' ]' }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @if ($instalacion->id_persona_juridica != null && $instalacion->id_persona_juridica != '')
                                        <tr>
                                            <th>NOMBRE DE LA EMPRESA O INSTITUCIÓN : </th>
                                            <td>
                                                <div class="alert alert-outline-dark">
                                                    <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                                        <div class="flex-1 font-Inter">
                                                            {{ $instalacion->persona_juridica->nombre_empresa }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th>CATEGORIA : </th>
                                        <td>
                                            <div class="alert alert-outline-dark">
                                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                                    <div class="flex-1 font-Inter">
                                                        {{ $instalacion->sub_categoria->nombre.' [ '.con_separador_comas($instalacion->sub_categoria->precio_fijo).' Bs ]' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        @php
                                            $fecha = new DateTime($instalacion->registro_cobros->fecha);
                                            $ano = date('Y', $fecha->getTimestamp());
                                        @endphp
                                        <th>AÑO Y MES DE INICIO A COBRAR : </th>
                                        <td>
                                            <div class="alert alert-outline-dark">
                                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                                    <div class="flex-1 font-Inter">
                                                        {{ $mes_unico->nombre_mes.' del '.$ano }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>

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
                                                <th scope="col" class="table-th">GESTIÓN</th>
                                                <th scope="col" class="table-th">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla_gestion_tab">
                                            @foreach ($gestion as $lis)
                                                <tr>
                                                    <td class='table-td' >{{ $loop->iteration }}</td>
                                                    <td class='table-td' >{{ $lis->gestion }}</td>
                                                    <td class='table-td' >
                                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                                            <button class="action-btn btn-success" onclick="cobrar_deuda_gestion('{{ $lis->id }}','{{ $instalacion->registro_cobros->id }}')" type="button">
                                                            <iconify-icon icon="heroicons:arrow-down-on-square-stack-solid"></iconify-icon>
                                                            </button>

                                                            <button class="action-btn btn-success" onclick="cobrar_de_toda_gestion('{{ $lis->id }}','{{ $instalacion->registro_cobros->id }}')" type="button">
                                                                <iconify-icon icon="heroicons:arrow-down-on-square-stack-solid"></iconify-icon>
                                                            </button>

                                                            <button class="action-btn btn-danger" onclick="eliminar_expedido('{{ $lis->id }}','{{ $instalacion->registro_cobros->id }}')" type="button">
                                                            <iconify-icon icon="heroicons:printer"></iconify-icon>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_cobro_servicio" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Cobros mensuales
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only"></span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-4" id="html_cobro_servicio">

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_cobro_servicio" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_cobro_servicio_anual" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Cobros mensuales
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only"></span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-4" id="html_cobro_servicio_anual">

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_cobro_servicio_anual" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_recaudaciones')
    <script>
        async function cobrar_deuda_gestion(id_gestion, id_registro_cobro) {
            try {
                let formData = new FormData();
                formData.append('id_gestion', id_gestion);
                formData.append('id_registro_cobro', id_registro_cobro);
                formData.append('_token', token);
                let response = await fetch("{{ route('lis_cobro_gestion') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    $('#modal_cobro_servicio').modal('show');
                    document.getElementById('html_cobro_servicio').innerHTML = data;
                } else {
                    console.error("Error en la solicitud AJAX:", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para pagar todo el año completo
        function cobrar_de_toda_gestion(id_gestion, id_registro_cobro){
            try {
                let formData = new FormData();
                formData.append('id_gestion', id_gestion);
                formData.append('id_registro_cobro', id_registro_cobro);
                formData.append('_token', token);
                let response = await fetch("{{ route('lis_cobro_anual') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    $('#modal_cobro_servicio_anual').modal('show');
                    document.getElementById('html_cobro_servicio_anual').innerHTML = data;
                } else {
                    console.error("Error en la solicitud AJAX:", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
    </script>
@endsection