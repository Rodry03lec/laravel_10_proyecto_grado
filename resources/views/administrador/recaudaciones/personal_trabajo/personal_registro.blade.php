@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| PERSONAL REGISTRO')
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
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Persona registradas</li>
        </ul>
    </div>

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                <div class="card-title text-slate-900 dark:text-white">Listado del personal</div>
                </div>
            </header>
            <div class="card-text h-full">
                <div>
                    <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a href="#tabs-home-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent active dark:text-slate-300" id="tabs-home-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-home-withIcon" role="tab" aria-controls="tabs-home-withIcon" aria-selected="true">
                            <iconify-icon class="mr-1" icon="heroicons-outline:users"></iconify-icon>
                            Personal Activo</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" id="tabs-profile-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile-withIcon" role="tab" aria-controls="tabs-profile-withIcon" aria-selected="false">
                            <iconify-icon class="mr-1" icon="heroicons-outline:users"></iconify-icon>
                            Personal Inactivo</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="tabs-tabContent">
                        <div class="tab-pane fade show active" id="tabs-home-withIcon" role="tabpanel" aria-labelledby="tabs-home-withIcon-tab">
                            <div class="flex flex-wrap justify-between items-center mb-4">
                                <header class="card-header noborder">
                                    <h4 class="card-title">Listado de personal activo</h4>
                                </header>
                                <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                                    <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nuevo_personal">
                                        <span class="flex items-center">
                                            <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                                            <span>Nuevo</span>
                                        </span>
                                    </button>
                                </div>
                            </div>

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
                                                        <th scope="col" class="table-th">NOMBRE</th>
                                                        <th scope="col" class="table-th">DESCRIPCIÓN</th>
                                                        <th scope="col" class="table-th">CARGOS</th>
                                                        <th scope="col" class="table-th">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabla_cargos_tab">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-profile-withIcon" role="tabpanel" aria-labelledby="tabs-profile-withIcon-tab">
                            <div class="flex flex-wrap justify-between items-center mb-4">
                                <header class="card-header noborder">
                                    <h4 class="card-title">Listado de personal inactivo</h4>
                                </header>
                            </div>

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
                                                        <th scope="col" class="table-th">NOMBRE</th>
                                                        <th scope="col" class="table-th">DESCRIPCIÓN</th>
                                                        <th scope="col" class="table-th">CARGOS</th>
                                                        <th scope="col" class="table-th">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tabla_cargos_tab">
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
        </div>
    </div>


    {{-- MODAL PARA CREAR LA NUEVA PERSONA NATURAL --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nuevo_personal" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Nuevo registro de persona Juridica
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_personal()">
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
                    <div class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto" id="scrollModal">
                        <form method="POST" id="form_nueva_personal" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_repre" name="id_repre">
                            <fieldset>
                                <legend>PERSONA</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                    <div class="input-area relative">
                                        <label for="ci_persona" class="form-label">INGRESE CI DE PERSONA</label>
                                        <input id="ci_persona" name="ci_persona" type="text" class="form-control" maxlength="10" placeholder="Ingrese ci persona" onkeyup="buscar_ci_persona(this.value)"  onkeypress="return soloNumeros(event)">
                                        <div id="_ci_persona"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <div class=" py-2 space-y-5" id="ver_persona">

                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>INFORMACIÓN</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">

                                    <div class="input-area relative">
                                        <label for="fecha_contratacion" class="form-label">FECHA DE CONTRATACIÓN</label>
                                        <input id="fecha_contratacion" name="fecha_contratacion" type="date" class="form-control" @disabled(true)>
                                        <div id="_fecha_contratacion"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="cargo" class="form-label">CARGO</label>
                                        <select name="cargo" id="cargo" class="select2_uno form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la cargo" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione cargo]</option>
                                            @foreach ($cargo as $lis)
                                                <option value="{{ $lis->id }}" class="inline-block font-Inter font-normal text-sm text-slate-600">[{{ $lis->nombre }}] : {{ $lis->descripcion }}</option>
                                            @endforeach

                                        </select>
                                        <div id="_cargo"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="referencia_laboral" class="form-label">REFERENCIA LABORAL (TELEFONO O CELULAR)</label>
                                        <input id="referencia_laboral" name="referencia_laboral" type="text" class="form-control" placeholder="Ingrese refrencia laboral" @disabled(true)>
                                        <div id="_referencia_laboral"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="nombre_referencia" class="form-label">REFERENCIA LABORAL (NOMBRE DE LA PERSONA)</label>
                                        <input id="nombre_referencia" name="nombre_referencia" type="text" class="form-control" placeholder="Ingrese el nombre de la referencia laboral" @disabled(true)>
                                        <div id="_nombre_referencia"></div>
                                    </div>
                                </div>
                            </fieldset>


                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_personal" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script_recaudaciones')
    <script>
        select2_uno('#modal_nuevo_personal');
        let ver_persona = document.getElementById('ver_persona');
        async function buscar_ci_persona(ci){
            let ci_error = document.getElementById('_ci_persona');
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('petr_buscar') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    console.log(dato);
                    if (dato.tipo === 'success') {
                        habilitar_deshabilitar_persona(false);
                        ver_persona.innerHTML = `
                        <div class="alert alert-outline-primary ">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    <dl class="list-none">
                                        <dt class="mb-1 font-bold">Nombres y apellidos : `+dato.mensaje[0].nombres+` `+dato.mensaje[0].apellido_paterno+` `+dato.mensaje[0].apellido_materno+ `</dt>
                                        <dd class="mb-1 font-bold"> Nº de celular : `+dato.mensaje[0].celular+`</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>`
                    }
                    if (dato.tipo === 'error') {
                        habilitar_deshabilitar_persona(true);
                        ver_persona.innerHTML='',
                        ci_error.innerHTML = `<p id="error_estilo" >`+dato.mensaje+`</p>`;
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                    habilitar_deshabilitar_persona(true);
                    ver_persona.innerHTML='',
                }
            }else{
                ci_error.innerHTML = '';
                habilitar_deshabilitar_persona(true);
                ver_persona.innerHTML='',
            }
        }
        //cuando cierre eñl modal
        function cerrar_modal_personal(){
            limpiar_campos('form_nueva_personal');
            vaciar_errores_personal();
            vaciar_select2();
        }
        //para vaciar los errores
        function vaciar_errores_personal(){
            let valores = ['ver_persona', '_fecha_contratacion', '_cargo', '_referencia_laboral', '_nombre_referencia'];
            valores.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }
        //vacair los select2
        function vaciar_select2(){
            document.querySelectorAll('.select2_uno').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
        }

        function habilitar_deshabilitar_persona(val){
            let valores = ['fecha_contratacion','cargo','referencia_laboral','nombre_referencia'];
            valores.forEach(elem => {
                document.getElementById(elem).disabled = val;
            });
        }
    </script>
@endsection
