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
                                    <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_unidad">
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
                                <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                                    <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_unidad">
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
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA CREAR LA NUEVA UNIDAD --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nueva_unidad" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Nueva unidad
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_cargo()">
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
                    <div class="p-6 space-y-4">
                        <form method="POST" id="form_nueva_unidad" autocomplete="off">
                            @csrf
                            <div class="input-area">
                                <label for="nombre" class="form-label">Ingrese nombre de la unidad</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese una nombre" onkeypress="return soloLetras(event)">
                                <div id="_nombre"></div>
                            </div>

                            <div class="input-area">
                                <label for="descripcion" class="form-label">Ingrese la descripción de la unidad</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="3" placeholder="Ingrese la descripcion de la unidad"></textarea>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_unidad" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA EDITAR UNIDAD --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_unidad" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Editar unidad
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_cargo()">
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
                    <div class="p-6 space-y-4">
                        <form method="POST" id="form_editar_unidad" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id_unidad" id="id_unidad">
                            <div class="input-area">
                                <label for="nombre_" class="form-label">Ingrese nombre de la unidad</label>
                                <input id="nombre_" name="nombre_" type="text" class="form-control" placeholder="Ingrese una nombre" onkeypress="return soloLetras(event)">
                                <div id="_nombre_"></div>
                            </div>

                            <div class="input-area">
                                <label for="descripcion_" class="form-label">Ingrese la descripción de la unidad</label>
                                <textarea name="descripcion_" id="descripcion_" class="form-control" cols="30" rows="3" placeholder="Ingrese la descripcion de la unidad"></textarea>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_unidad_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
