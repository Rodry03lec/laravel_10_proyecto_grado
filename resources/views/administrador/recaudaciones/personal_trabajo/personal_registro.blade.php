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
                                            <table id="tab_listar_personal_activo" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                                style="width: 100%">
                                                <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                                    <tr>
                                                        <th scope="col" class="table-th">ID</th>
                                                        <th scope="col" class="table-th">CI</th>
                                                        <th scope="col" class="table-th">NOMBRE</th>
                                                        <th scope="col" class="table-th">FECHA DE CONTRATACIÓN</th>
                                                        <th scope="col" class="table-th">CARGO</th>
                                                        <th scope="col" class="table-th">ACCIONES</th>
                                                    </tr>
                                                </thead>
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
                                            <table id="tab_listar_personal_inactivo" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                                style="width: 100%">
                                                <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                                    <tr>
                                                        <th scope="col" class="table-th">ID</th>
                                                        <th scope="col" class="table-th">CI</th>
                                                        <th scope="col" class="table-th">NOMBRE</th>
                                                        <th scope="col" class="table-th">FECHA DE CONTRATACIÓN</th>
                                                        <th scope="col" class="table-th">FECHA DE FINALIZACIÓN</th>
                                                        <th scope="col" class="table-th">CARGO</th>
                                                        <th scope="col" class="table-th">ACCIONES</th>
                                                    </tr>
                                                </thead>
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
                            Nuevo registro de personal de trabajo
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
                            <input type="hidden" id="id_persona" name="id_persona">
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
                                        <label for="referencia_celular" class="form-label">REFERENCIA LABORAL (TELEFONO O CELULAR)</label>
                                        <input id="referencia_celular" name="referencia_celular" onkeypress="return soloNumeros(event)" type="text" class="form-control" placeholder="Ingrese refrencia laboral" @disabled(true)>
                                        <div id="_referencia_celular"></div>
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

    {{-- MODAL PARA EDITAR LA PERSONA NATURAL --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_personal" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Editar registro de personal de trabajo
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
                        <form method="POST" id="form_editar_personal" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_personal_tabajo" name="id_personal_tabajo">

                            <fieldset>
                                <legend>INFORMACIÓN</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">

                                    <div class="input-area relative">
                                        <label for="fecha_contratacion_" class="form-label">FECHA DE CONTRATACIÓN</label>
                                        <input id="fecha_contratacion_" name="fecha_contratacion_" type="date" class="form-control">
                                        <div id="_fecha_contratacion_"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="cargo_" class="form-label">CARGO</label>
                                        <select name="cargo_" id="cargo_" class="select2_dos form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la cargo" >
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione cargo]</option>
                                            @foreach ($cargo as $lis)
                                                <option value="{{ $lis->id }}" class="inline-block font-Inter font-normal text-sm text-slate-600">[{{ $lis->nombre }}] : {{ $lis->descripcion }}</option>
                                            @endforeach

                                        </select>
                                        <div id="_cargo_"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="referencia_celular_" class="form-label">REFERENCIA LABORAL (TELEFONO O CELULAR)</label>
                                        <input id="referencia_celular_" name="referencia_celular_" onkeypress="return soloNumeros(event)" type="text" class="form-control" placeholder="Ingrese refrencia laboral" >
                                        <div id="_referencia_celular_"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="nombre_referencia_" class="form-label">REFERENCIA LABORAL (NOMBRE DE LA PERSONA)</label>
                                        <input id="nombre_referencia_" name="nombre_referencia_" type="text" class="form-control" placeholder="Ingrese el nombre de la referencia laboral">
                                        <div id="_nombre_referencia_"></div>
                                    </div>
                                </div>
                            </fieldset>


                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_personal_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CAMBIAR EL ESTADO Y MANDARLO A INACTIVO --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_estado_personal" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Estado registro de personal de trabajo
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
                        <form method="POST" id="form_estado_personal" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_personal_trabajo" name="id_personal_trabajo">
                            <fieldset>
                                <legend>DATOS</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
                                    <table class="table">
                                        <tr>
                                            <th>CI:</th>
                                            <td>
                                                <div id="ci_persona_estado" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>NOMBRES:</th>
                                            <td>
                                                <div id="nombres_persona_estado" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>CARGO:</th>
                                            <td>
                                                <div id="cargo_persona_estado" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>FECHA DE CONTRATACIÓN:</th>
                                            <td>
                                                <div id="fecha_contratacion_persona_estado" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>REFERENCIA:</th>
                                            <td>
                                                <div id="referencia_persona_estado" >
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>DESCRIBA TODA LA INFORMACIÓN DEL POR QUE?</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
                                    <div class="input-area relative">
                                        <label for="fecha_finalizacion" class="form-label">FECHA DE FINALIZACIÓN</label>
                                        <input id="fecha_finalizacion" name="fecha_finalizacion" type="date" value="{{ date('Y-m-d') }}" class="form-control">
                                        <div id="_fecha_finalizacion"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="descripcion__" class="form-label">DESCRIPCIÓN </label>
                                        <textarea name="descripcion__" id="descripcion__" cols="30" rows="4" class="form-control" placeholder="Ingrese la descripcion detallado"></textarea>
                                        <div id="_descripcion__"></div>
                                    </div>
                                </div>
                            </fieldset>


                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_personal_estado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CAMBIAR EL ESTADO Y MANDARLO A INACTIVO --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_detalle_personal" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Detalle del personal
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
                    <div class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto" id="scrollModal">
                        <fieldset>
                            <legend>DATOS</legend>
                            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
                                <table class="table">
                                    <tr>
                                        <th>CI:</th>
                                        <td>
                                            <div id="ci_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NOMBRES:</th>
                                        <td>
                                            <div id="nombres_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CARGO:</th>
                                        <td>
                                            <div id="cargo_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>FECHA DE CONTRATACIÓN:</th>
                                        <td>
                                            <div id="fecha_contratacion_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>FECHA DE FINALIZACIÓN:</th>
                                        <td>
                                            <div id="fecha_finalizacion_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>DESCRIPCIÓN:</th>
                                        <td>
                                            <div id="descripcion_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>REFERENCIA:</th>
                                        <td>
                                            <div id="referencia_persona_detalle" >
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script_recaudaciones')
    <script>
        select2_uno('#modal_nuevo_personal');
        select2_dos('#form_editar_personal');


        let id_unidad = {{ $id_descript }};

        //para listar el personal activo
        async function listar_personal_activo(){
            try {
                let respuesta = await fetch("{{ route('petr_lisar_act') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id_unidad:id_unidad})
                });
                let dato = await respuesta.json();
                let i = 1;
                $('#tab_listar_personal_activo').DataTable({
                    responsive: true,
                    data: dato,
                    columns: [
                    {
                        data: null,
                        className: 'table-td',
                        render: function(){
                            return i++;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if (row.persona_natural.complemento !== null && row.persona_natural.complemento !== '') {
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+ row.persona_natural.ci+'-'+row.complemento+' '+row.persona_natural.expedido.sigla+`</span>`;
                            } else {
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.persona_natural.ci+' '+row.persona_natural.expedido.sigla+`</span>` ;
                            }
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.persona_natural.nombres+' '+row.persona_natural.apellido_paterno+' '+row.persona_natural.apellido_materno;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.fecha_contratacion;
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.cargo.nombre;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `
                                <div class="flex space-x-3 items-center ">
                                    <button class=" action-btn btn-success" onclick="estado_personal_trabajo('${row.id}')" >
                                        <iconify-icon icon="heroicons:arrow-path-20-solid"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-warning" onclick="editar_personal_trabajo('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-danger" onclick="eliminar_personal_trabajo('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </button>
                                </div>
                            `;
                        }
                    }
                    ]
                });
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
        listar_personal_activo();


        let ver_persona = document.getElementById('ver_persona');
        async function buscar_ci_persona(ci){
            let id_persona = document.getElementById('id_persona');
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
                        </div>`;
                        ci_error.innerHTML = `<p id="success_estilo" >`+dato.mensaje_mostrar+`</p>`;
                        id_persona.value = dato.mensaje[0].id;
                    }
                    if (dato.tipo === 'error_funcionario') {
                        habilitar_deshabilitar_persona(true);
                        ver_persona.innerHTML='';
                        ci_error.innerHTML = `<p id="error_estilo" >`+dato.mensaje+`</p>`;
                        id_persona.value = '';
                    }

                    if(dato.tipo === 'error_registro'){
                        habilitar_deshabilitar_persona(true);
                        ver_persona.innerHTML='';
                        ci_error.innerHTML = `<p id="error_estilo" >`+dato.mensaje+` <a style="color:blue; cursor:pointer" href="{{ route('pna_index') }}">[ registre! ]</a> </p>`;
                        id_persona.value = '';
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                    habilitar_deshabilitar_persona(true);
                    ver_persona.innerHTML='';
                    id_persona.value = '';
                }
            }else{
                ci_error.innerHTML = '';
                habilitar_deshabilitar_persona(true);
                ver_persona.innerHTML='';
                id_persona.value = '';
            }
        }
        //cuando cierre eñl modal
        function cerrar_modal_personal(){
            limpiar_campos('form_nueva_personal');
            limpiar_campos('form_editar_personal');
            vaciar_errores_personal();
            vaciar_select2();
            habilitar_deshabilitar_persona(true);
            document.getElementById('_ci_persona').innerHTML = '';
        }
        //para vaciar los errores
        function vaciar_errores_personal(){
            let valores = ['ver_persona', '_fecha_contratacion', '_cargo', '_referencia_celular', '_nombre_referencia', '_fecha_contratacion_', '_cargo_', '_referencia_celular_', '_nombre_referencia_', '_fecha_finalizacion', '_descripcion__'];
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
            document.querySelectorAll('.select2_dos').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
        }

        function habilitar_deshabilitar_persona(val){
            let valores = ['fecha_contratacion','cargo','referencia_celular','nombre_referencia'];
            valores.forEach(elem => {
                document.getElementById(elem).disabled = val;
            });
        }

        //para guardar el registro
        let guardar_personal_btn = document.getElementById('btn_guardar_personal');
        guardar_personal_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nueva_personal')).entries());
            try {
                let respuesta = await fetch("{{ route('petr_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_personal();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#tab_listar_personal_activo').fadeOut(200, function() {
                        $('#tab_listar_personal_activo').DataTable().destroy();
                        listar_personal_activo();
                        cerrar_modal_personal();
                        $('#modal_nuevo_personal').modal('hide');
                        $('#tab_listar_personal_activo').fadeIn(200);
                    });
                    $('#tab_listar_personal_inactivo').fadeOut(200, function() {
                        $('#tab_listar_personal_inactivo').DataTable().destroy();
                        listar_personal_inactivo();
                        $('#tab_listar_personal_inactivo').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para editar el personal trabajo
        async function editar_personal_trabajo(id){
            vaciar_errores_personal();
            try {
                let respuesta = await fetch("{{ route('petr_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_personal').modal('show');
                    document.getElementById('id_personal_tabajo').value    = dato.mensaje.id;
                    document.getElementById('fecha_contratacion_').value   = dato.mensaje.fecha_contratacion;
                    //cargo
                    let selectElement = document.getElementById('cargo_');
                    selectElement.value = dato.mensaje.id_cargo;
                    selectElement.dispatchEvent(new Event('change'));
                    //cargo
                    document.getElementById('referencia_celular_').value   = dato.mensaje.referencia_celular;
                    document.getElementById('nombre_referencia_').value    = dato.mensaje.referencia_nombre;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar lo editado
        let guardar_personal_editado_btn = document.getElementById('btn_guardar_personal_editado');
        guardar_personal_editado_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_personal')).entries());
            try {
                let respuesta = await fetch("{{ route('petr_edi_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_personal();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#tab_listar_personal_activo').fadeOut(200, function() {
                        $('#tab_listar_personal_activo').DataTable().destroy();
                        listar_personal_activo();
                        cerrar_modal_personal();
                        $('#modal_editar_personal').modal('hide');
                        $('#tab_listar_personal_activo').fadeIn(200);
                    });
                    $('#tab_listar_personal_inactivo').fadeOut(200, function() {
                        $('#tab_listar_personal_inactivo').DataTable().destroy();
                        listar_personal_inactivo();
                        $('#tab_listar_personal_inactivo').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para que el personal que esta se de como inactivo
        async function estado_personal_trabajo(id) {
            try {
                let respuesta = await fetch("{{ route('petr_estado') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id, id_unidad:id_unidad})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_estado_personal').modal('show');

                    document.getElementById('id_personal_trabajo').value = dato.mensaje.id;

                    if(dato.mensaje.persona_natural.complemento !== null && dato.mensaje.persona_natural.complemento !== ''){
                        document.getElementById('ci_persona_estado').innerHTML = `
                            <div class="alert alert-outline-dark">
                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                    <div class="flex-1 font-Inter">
                                        `+dato.mensaje.persona_natural.ci+ ` - `+dato.mensaje.persona_natural.complemento+` `+dato.mensaje.persona_natural.expedido.sigla+`
                                    </div>
                                </div>
                            </div>
                        `;
                    }else{
                        document.getElementById('ci_persona_estado').innerHTML = `
                            <div class="alert alert-outline-dark">
                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                    <div class="flex-1 font-Inter">
                                        `+dato.mensaje.persona_natural.ci+` `+dato.mensaje.persona_natural.expedido.sigla+`
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                    document.getElementById('nombres_persona_estado').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.persona_natural.nombres+` `+dato.mensaje.persona_natural.apellido_paterno+` `+dato.mensaje.persona_natural.apellido_materno+`
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('cargo_persona_estado').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.cargo.nombre+` : `+ dato.mensaje.cargo.descripcion +`
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('fecha_contratacion_persona_estado').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.fecha_contratacion +`
                                </div>
                            </div>
                        </div>
                    `;

                    document.getElementById('referencia_persona_estado').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    Nº celular : `+dato.mensaje.referencia_celular +` Nombre: [`+dato.mensaje.referencia_nombre+`]
                                </div>
                            </div>
                        </div>
                    `;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar el personas de trabajo dando de baja al estado
        let guardar_personal_estado_btn = document.getElementById('btn_guardar_personal_estado');
        guardar_personal_estado_btn.addEventListener('click', async ()=>{
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'NOTA!',
                text: "Esta seguro de finalizar el contrato?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, seguro',
                cancelButtonText: 'No, cancelar',
                reverseButtons: true
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let datos = Object.fromEntries(new FormData(document.getElementById('form_estado_personal')).entries());
                    try {
                        let respuesta = await fetch("{{ route('petr_estado_guardar') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(datos)
                        });
                        let dato = await respuesta.json();
                        vaciar_errores_personal();
                        if (dato.tipo === 'errores') {
                            let obj = dato.mensaje;
                            for (let key in obj) {
                                document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                            }
                        }
                        if (dato.tipo === 'success') {
                            alerta_top(dato.tipo, dato.mensaje);
                            $('#tab_listar_personal_activo').fadeOut(200, function() {
                                $('#tab_listar_personal_activo').DataTable().destroy();
                                listar_personal_activo();
                                cerrar_modal_personal();
                                $('#modal_estado_personal').modal('hide');
                                $('#tab_listar_personal_activo').fadeIn(200);
                            });
                            $('#tab_listar_personal_inactivo').fadeOut(200, function() {
                                $('#tab_listar_personal_inactivo').DataTable().destroy();
                                listar_personal_inactivo();
                                $('#tab_listar_personal_inactivo').fadeIn(200);
                            });
                        }
                        if (dato.tipo === 'error') {
                            alerta_top(dato.tipo, dato.mensaje);
                        }
                    } catch (error) {
                        console.log('Error de datos : ' + error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        });

        //poara eliminar
        function eliminar_personal_trabajo(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'NOTA!',
                text: "Esta seguro de eliminar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, cancelar',
                reverseButtons: true
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let respuesta = await fetch("{{ route('petr_eliminar') }}", {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        alerta_top(dato.tipo, dato.mensaje);
                        $('#tab_listar_personal_activo').fadeOut(200, function() {
                            $('#tab_listar_personal_activo').DataTable().destroy();
                            listar_personal_activo();
                            $('#tab_listar_personal_activo').fadeIn(200);
                        });

                        $('#tab_listar_personal_inactivo').fadeOut(200, function() {
                            $('#tab_listar_personal_inactivo').DataTable().destroy();
                            listar_personal_inactivo();
                            $('#tab_listar_personal_inactivo').fadeIn(200);
                        });
                    }
                    if (dato.tipo === 'error') {
                        alerta_top(dato.tipo, dato.mensaje);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        }

        //para listar las personas que ya estan inactivas
        async function listar_personal_inactivo(){
            try {
                let respuesta = await fetch("{{ route('petr_listar_inac') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id_unidad:id_unidad})
                });
                let dato = await respuesta.json();
                let i = 1;
                $('#tab_listar_personal_inactivo').DataTable({
                    responsive: true,
                    data: dato,
                    columns: [
                    {
                        data: null,
                        className: 'table-td',
                        render: function(){
                            return i++;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if (row.persona_natural.complemento !== null && row.persona_natural.complemento !== '') {
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+ row.persona_natural.ci+'-'+row.complemento+' '+row.persona_natural.expedido.sigla+`</span>`;
                            } else {
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.persona_natural.ci+' '+row.persona_natural.expedido.sigla+`</span>` ;
                            }
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.persona_natural.nombres+' '+row.persona_natural.apellido_paterno+' '+row.persona_natural.apellido_materno;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.fecha_contratacion;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.fecha_finalizacion;
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.cargo.nombre;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `
                                <div class="flex space-x-3 items-center ">
                                    <button class=" action-btn btn-primary" onclick="ver_detallado_personal('${row.id}')" >
                                        <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </button>
                                </div>
                            `;
                        }
                    }
                    ]
                });
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
        listar_personal_inactivo();

        //para mostrar los datos de la persona que esta inactiva por que razon se le despedio o nose
        async function ver_detallado_personal(id){
            try {
                let respuesta = await fetch("{{ route('petr_estado') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id, id_unidad:id_unidad})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_detalle_personal').modal('show');

                    document.getElementById('id_personal_trabajo').value = dato.mensaje.id;

                    if(dato.mensaje.persona_natural.complemento !== null && dato.mensaje.persona_natural.complemento !== ''){
                        document.getElementById('ci_persona_detalle').innerHTML = `
                            <div class="alert alert-outline-dark">
                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                    <div class="flex-1 font-Inter">
                                        `+dato.mensaje.persona_natural.ci+ ` - `+dato.mensaje.persona_natural.complemento+` `+dato.mensaje.persona_natural.expedido.sigla+`
                                    </div>
                                </div>
                            </div>
                        `;
                    }else{
                        document.getElementById('ci_persona_detalle').innerHTML = `
                            <div class="alert alert-outline-dark">
                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                    <div class="flex-1 font-Inter">
                                        `+dato.mensaje.persona_natural.ci+` `+dato.mensaje.persona_natural.expedido.sigla+`
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                    document.getElementById('nombres_persona_detalle').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.persona_natural.nombres+` `+dato.mensaje.persona_natural.apellido_paterno+` `+dato.mensaje.persona_natural.apellido_materno+`
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('cargo_persona_detalle').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.cargo.nombre+` : `+ dato.mensaje.cargo.descripcion +`
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('fecha_contratacion_persona_detalle').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.fecha_contratacion +`
                                </div>
                            </div>
                        </div>
                    `;

                    document.getElementById('fecha_finalizacion_persona_detalle').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.fecha_finalizacion +`
                                </div>
                            </div>
                        </div>
                    `;

                    document.getElementById('descripcion_persona_detalle').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    `+dato.mensaje.descripcion +`
                                </div>
                            </div>
                        </div>
                    `;

                    document.getElementById('referencia_persona_detalle').innerHTML = `
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    Nº celular : `+dato.mensaje.referencia_celular +` Nombre: [`+dato.mensaje.referencia_nombre+`]
                                </div>
                            </div>
                        </div>
                    `;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
    </script>
@endsection
