@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| NATURAL')
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
            Configuración
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
        </li>
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Persona natural</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Listado de Persona Natural</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_persona_natural">
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
                        <table id="listar_per_natural" class=" dark:divide-slate-700 min-w-full divide-y divide-gray-200 {{-- data-table --}}"
                            style="width: 100%">
                            <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                <tr>
                                    <th scope="col" class="table-th">Nº</th>
                                    <th scope="col" class="table-th">NOMBRES Y APELLIDOS</th>
                                    <th scope="col" class="table-th">CI</th>
                                    <th scope="col" class="table-th">Nº CELULAR</th>
                                    <th scope="col" class="table-th">DIRECCIÓN</th>
                                    <th scope="col" class="table-th">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA CREAR LA NUEVA PERSONA NATURAL --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nueva_persona_natural" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Nuevo registro de persona Natural
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_persona_natural()">
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
                        <form method="POST" id="form_nueva_persona_natural" autocomplete="off">
                            @csrf
                            <fieldset>
                                <legend>INFORMACIÓN PERSONAL</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-7">
                                    <div class="input-area relative">
                                        <label for="ci" class="form-label">CI</label>
                                        <input id="ci" name="ci" type="text" class="form-control" placeholder="Ingrese un CI" onkeyup="validar_ci_natural(this.value)" onkeypress="return soloNumeros(event);" maxlength="10" >
                                        <div id="_ci"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input id="complemento" name="complemento" type="text" class="form-control" maxlength="5" placeholder="Ingrese el complemento si lo tiene" @disabled(true)>
                                        <div id="_complemento"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="nombres" class="form-label">Expedido</label>
                                        <select name="expedido" id="expedido" class="form-control w-full mt-2" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione Expedido]</option>
                                            @foreach ($expedido as $lis)
                                                <option value="{{ $lis->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ '['.$lis->sigla.']  '.$lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_expedido" ></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input id="nombres" name="nombres" type="text" class="form-control" placeholder="Ingrese sus nombres" onkeypress="return soloLetras(event)" @disabled(true)>
                                        <div id="_nombres"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                        <input id="apellido_paterno" name="apellido_paterno" type="text" class="form-control" placeholder="Ingrese su apellido Paterno" onkeypress="return soloLetras(event)" @disabled(true)>
                                        <div id="_apellido_paterno"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="apellido_materno" class="form-label">Apellido Materno</label>
                                        <input id="apellido_materno" name="apellido_materno" type="text" class="form-control" placeholder="Ingrese su apellido Materno" onkeypress="return soloLetras(event)" @disabled(true)>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="genero" class="form-label">Seleccione género</label>
                                        <select name="genero" id="genero" class="form-control w-full mt-2" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione género]</option>
                                            <option value="M" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Masculino</option>
                                            <option value="F" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Femenino</option>
                                            <option value="ND" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Prefiere no decir</option>
                                        </select>
                                        <div id="_genero" ></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="estado_civil" class="form-label">Estado civil</label>
                                        <select name="estado_civil" id="estado_civil" class="form-control w-full mt-2" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione estado civil]</option>
                                            <option value="Soltero(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Soltero(a)</option>
                                            <option value="Casado(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Casado(a)</option>
                                            <option value="Divorciado(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Divorciado(a)</option>
                                            <option value="Concubino(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Concubino(a)</option>
                                            <option value="Prefiere no decir" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Prefiere no decir</option>
                                        </select>
                                        <div id="_estado_civil" ></div>
                                    </div>

                                    <div class="input-area relative" >
                                        <label for="profesion" class="form-label">Seleccione la profesión</label>
                                        <select name="profesion[]" id="profesion" class="select2 form-control w-full mt-2 py-2 text-lg" aria-placeholder="ingrese" multiple="multiple" @disabled(true)>
                                            @foreach ($profesion as $lis)
                                                <option value="{{ $lis->id }}" class=" inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </fieldset>

                            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                <fieldset>
                                    <legend>CONTACTOS</legend>
                                    <div class="input-area relative">
                                        <label for="email_persona" class="form-label">Email</label>
                                        <input id="email_persona" name="email_persona" type="email" class="form-control" placeholder="Ingrese un gmail" @disabled(true)>
                                        <div id="_email_persona"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="celular" class="form-label">Nº de celular</label>
                                        <input id="celular_persona" name="celular_persona" type="tel" class="form-control" onkeypress="return soloNumeros(event);" placeholder="Ingrese número de celular" @disabled(true) maxlength="10">
                                        <div id="_celular_persona"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="numero_referencia" class="form-label">Nº de celular de referencia</label>
                                        <input id="numero_referencia" name="numero_referencia" type="cel" class="form-control" onkeypress="return soloNumeros(event);" placeholder="Ingrese número de celular de referencia" @disabled(true) maxlength="10">
                                        <div id="_numero_referencia"></div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>DIRECCIÓN</legend>
                                    <div class="input-area relative" >
                                        <label for="zona" class="form-label">Seleccione la zona</label>
                                        <select name="zona" id="zona" class="select2_uno form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la zona" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione la zona]</option>
                                            @foreach ($zonas as $lis)
                                                <option value="{{ $lis->id }}" class=" inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_zona"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="direccion" class="form-label">Dirección de domicilio</label>
                                        <textarea class="form-control" name="direccion" id="direccion" cols="30" rows="1" placeholder="Ingrese la dirección" @disabled(true)></textarea>
                                        <div id="_direccion"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="informacion_adicional" class="form-label">Información adicional</label>
                                        <textarea class="form-control" name="informacion_adicional" id="informacion_adicional" cols="30" rows="2" placeholder="Ingrese una información adicional " @disabled(true)></textarea>
                                        <div id="_informacion_adicional"></div>
                                    </div>
                                </fieldset>
                            </div>

                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_persona_natural" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA EDITAR LA PAERSONA NATURAL --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_persona_natural" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Editar registro de persona Natural
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_persona_natural()">
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
                        <form method="POST" id="form_editar_persona_natural" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id_persona_natural" id="id_persona_natural">
                            <fieldset>
                                <legend>INFORMACIÓN PERSONAL</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-7">
                                    <div class="input-area relative">
                                        <label for="ci_" class="form-label">CI</label>
                                        <input id="ci_" name="ci_" type="text" class="form-control" placeholder="Ingrese un CI" {{-- onkeyup="validar_ci_natural(this.value)" --}} onkeypress="return soloNumeros(event);" @disabled(true)>
                                        <div id="_ci_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input id="complemento_" name="complemento_" type="text" class="form-control" maxlength="5" placeholder="Ingrese el complemento si lo tiene">
                                        <div id="_complemento"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="expedido_" class="form-label">Expedido</label>
                                        <select name="expedido_" id="expedido_" class="form-control w-full mt-2">
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione Expedido]</option>
                                            @foreach ($expedido as $lis)
                                                <option value="{{ $lis->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ '['.$lis->sigla.']  '.$lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_expedido_" ></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="nombres_" class="form-label">Nombres</label>
                                        <input id="nombres_" name="nombres_" type="text" class="form-control" placeholder="Ingrese sus nombres">
                                        <div id="_nombres_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="apellido_paterno_" class="form-label">Apellido Paterno</label>
                                        <input id="apellido_paterno_" name="apellido_paterno_" type="text" class="form-control" placeholder="Ingrese su apellido Paterno">
                                        <div id="_apellido_paterno_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="apellido_materno_" class="form-label">Apellido Materno</label>
                                        <input id="apellido_materno_" name="apellido_materno_" type="text" class="form-control" placeholder="Ingrese su apellido Materno" >
                                    </div>
                                    <div class="input-area relative">
                                        <label for="genero_" class="form-label">Seleccione género</label>
                                        <select name="genero_" id="genero_" class="form-control w-full mt-2">
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione género]</option>
                                            <option value="M" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Masculino</option>
                                            <option value="F" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Femenino</option>
                                            <option value="ND" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Prefiere no decir</option>
                                        </select>
                                        <div id="_genero_" ></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="estado_civil_" class="form-label">Estado civil</label>
                                        <select name="estado_civil_" id="estado_civil_" class="form-control w-full mt-2" >
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione estado civil]</option>
                                            <option value="Soltero(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Soltero(a)</option>
                                            <option value="Casado(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Casado(a)</option>
                                            <option value="Divorciado(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Divorciado(a)</option>
                                            <option value="Concubino(a)" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Concubino(a)</option>
                                            <option value="Prefiere no decir" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Prefiere no decir</option>
                                        </select>
                                        <div id="_estado_civil_" ></div>
                                    </div>

                                    <div class="input-area relative" >
                                        <label for="profesion_edi" class="form-label">Seleccione la profesión</label>
                                        <select name="profesion_edi[]" id="profesion_edi" class="select2_dos form-control w-full mt-2 py-2 text-lg" aria-placeholder="ingrese" multiple="multiple" >
                                            @foreach ($profesion as $lis)
                                                <option value="{{ $lis->id }}" class=" inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </fieldset>

                            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                <fieldset>
                                    <legend>CONTACTOS</legend>
                                    <div class="input-area relative">
                                        <label for="email_persona_" class="form-label">Email</label>
                                        <input id="email_persona_" name="email_persona_" type="email" class="form-control" placeholder="Ingrese un gmail" >
                                        <div id="_email_persona_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="celular_persona_" class="form-label">Nº de celular</label>
                                        <input id="celular_persona_" name="celular_persona_" type="tel" class="form-control" onkeypress="return soloNumeros(event);" placeholder="Ingrese número de celular" maxlength="10">
                                        <div id="_celular_persona_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="numero_referencia_" class="form-label">Nº de celular de referencia</label>
                                        <input id="numero_referencia_" name="numero_referencia_" type="cel" class="form-control" onkeypress="return soloNumeros(event);" placeholder="Ingrese número de celular de referencia" maxlength="10">
                                        <div id="_numero_referencia_"></div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>DIRECCIÓN</legend>
                                    <div class="input-area relative" >
                                        <label for="zona_" class="form-label">Seleccione la zona</label>
                                        <select name="zona_" id="zona_" class="select2_tres form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la zona">
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione la zona]</option>
                                            @foreach ($zonas as $lis)
                                                <option value="{{ $lis->id }}" class=" inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_zona_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="direccion_" class="form-label">Dirección de domicilio</label>
                                        <textarea class="form-control" name="direccion_" id="direccion_" cols="30" rows="1" placeholder="Ingrese la dirección"></textarea>
                                        <div id="_direccion_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="informacion_adicional_" class="form-label">Información adicional</label>
                                        <textarea class="form-control" name="informacion_adicional_" id="informacion_adicional_" cols="30" rows="2" placeholder="Ingrese una información adicional "></textarea>
                                        <div id="_informacion_adicional_"></div>
                                    </div>
                                </fieldset>
                            </div>

                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_persona_natural_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_vizualizar_persona_natural" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Vizualizar registro de persona Natural
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
                    <div class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto" {{-- id="scrollModal" --}} id="vizualizar_persona_natural">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script_recaudaciones')
    <script>
        function cerrar_modal_persona_natural(){
            limpiar_campos('form_nueva_persona_natural');
            limpiar_campos('form_editar_persona_natural');
            vaciar_select_select2_natural();
            deshabilitar_habilitar_natural(true);
            vaciar_errores_natural();
        }

        //para vaciar los select
        function vaciar_select_select2_natural(){
            document.querySelectorAll('.select2').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
            document.querySelectorAll('.select2_uno').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });

            document.querySelectorAll('.select2_dos').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
            document.querySelectorAll('.select2_tres').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
        }


        select2_prueva('#modal_nueva_persona_natural');
        select2_uno('#modal_nueva_persona_natural');
        select2_dos('#modal_editar_persona_natural');
        select2_tres('#modal_editar_persona_natural');


        /*
            para listar la persona natural
        */
       //para listar los datos
        async function listar_persona_natural() {
            let respuesta = await fetch("{{ route('pna_listar') }}");
            let dato = await respuesta.json();
            let i = 1;
            $('#listar_per_natural').DataTable({
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
                            return row.nombres + ' ' + row.apellido_paterno+' '+row.apellido_materno;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if (row.complemento !== null && row.complemento !== '') {
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+ row.ci+'-'+row.complemento+' '+row.expedido.sigla+`</span>`;
                            } else {
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.ci+' '+row.expedido.sigla+`</span>` ;
                            }
                        }
                    },
                    {
                        data: 'celular',
                        className: 'table-td'
                    },
                    {
                        data: 'direccion',
                        className: 'table-td'
                    },
                    /* {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if (Array.isArray(row.profesion) && row.profesion.length > 0) {
                                // Itera sobre el array y construye una cadena con las descripciones de las profesiones
                                var profesionesString = row.profesion.map(function(profesion) {
                                    return `<div class="card-text h-full space-x-3"> <span class="badge bg-primary-500 text-primary-500 bg-opacity-30 capitalize pill">`+ profesion.descripcion+`</span> </div>` ;
                                }).join('</br>');
                                return profesionesString;
                            } else {
                                return `<span class="badge bg-primary-500 text-primary-500 bg-opacity-30 capitalize pill">Sin profesión</span>` ;
                            }
                        }
                    }, */
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `
                                <div class="flex space-x-3 items-center ">
                                    <button class=" action-btn btn-primary" onclick="ver_persona_natural('${row.id}')" >
                                        <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-warning" onclick="editar_persona_natural('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-danger" onclick="eliminar_persona_natural('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        }
        listar_persona_natural();


        //para validar ci de la persona natural si existe
        async function validar_ci_natural(ci){
            let ci_error = document.getElementById('_ci');
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('pna_validar') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        deshabilitar_habilitar_natural(false);
                    }
                    if (dato.tipo === 'error') {
                        ci_error.innerHTML  = `<p id="error_estilo" >`+dato.mensaje+`</p>`;
                        alerta_top('error', dato.mensaje);
                        deshabilitar_habilitar_natural(true);
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                }
            }else{
                ci_error.innerHTML = '';
                deshabilitar_habilitar_natural(true);
            }
        }


        //para desabiliar y habiltar los input
        function deshabilitar_habilitar_natural(val){
            let valores_des_hab = ['complemento','expedido','nombres','apellido_paterno','apellido_materno','genero','estado_civil','profesion','email_persona', 'celular_persona', 'numero_referencia', 'zona', 'direccion', 'informacion_adicional'];
            valores_des_hab.forEach(elem => {
                document.getElementById(elem).disabled = val;
            });

            //si es que no hay registro o hay entra
            if(val===true){
                  //para vaciar los input
                let valores_input= ['complemento','nombres','apellido_paterno','apellido_materno', 'email_persona', 'celular_persona', 'numero_referencia', 'direccion', 'informacion_adicional'];
                valores_input.forEach(elem => {
                    document.getElementById(elem).value = '';
                });

                //ahora para los select normal
                let valores_select_normal = ['expedido','genero','estado_civil'];
                valores_select_normal.forEach(elem => {
                    document.getElementById(elem).value = 'selected';
                });

                vaciar_select_select2_natural();
                vaciar_errores_natural();
            }
        }
        //para vaciar los errores
        function vaciar_errores_natural(){
            let valores_errores = ['_ci','_expedido','_nombres','_apellido_paterno','_genero','_estado_civil','_email_persona', '_celular_persona', '_numero_referencia', '_zona', '_direccion', '_informacion_adicional', '_ci_','_expedido_','_nombres_','_apellido_paterno_','_genero_','_estado_civil_','_email_persona_', '_celular_persona_', '_numero_referencia_', '_zona_', '_direccion_', '_informacion_adicional_'];
            valores_errores.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }

        //para guardar la persona natural
        let guardar_persona_natural_btn = document.getElementById('btn_guardar_persona_natural');
        guardar_persona_natural_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nueva_persona_natural')).entries());

            //para seleccionar profesiones
            let profesion = [];
            let seleccion_profesiones = document.querySelectorAll('select[name="profesion[]"] option:checked');
            seleccion_profesiones.forEach(function (option) {
                profesion.push(option.value);
            });
            try {
                let respuesta = await fetch("{{ route('pna_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        ci  : datos.ci,
                        complemento : datos.complemento,
                        expedido : datos.expedido,
                        nombres : datos.nombres,
                        apellido_paterno : datos.apellido_paterno,
                        apellido_materno : datos.apellido_materno,
                        genero : datos.genero,
                        estado_civil:datos.estado_civil,
                        profesion : profesion,
                        email_persona : datos.email_persona,
                        celular_persona : datos.celular_persona,
                        numero_referencia : datos.numero_referencia,
                        zona:datos.zona,
                        direccion : datos.direccion,
                        informacion_adicional: datos.informacion_adicional
                    })
                });
                let dato = await respuesta.json();
                vaciar_errores_natural();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_per_natural').fadeOut(200, function() {
                        $('#listar_per_natural').DataTable().destroy();
                        listar_persona_natural();
                        cerrar_modal_persona_natural();
                        $('#modal_nueva_persona_natural').modal('hide');
                        $('#listar_per_natural').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });



        //PARA EDITAR LOS DATOS DEL LA PERSONA NATURAL
        async function editar_persona_natural(id){
            try {
                let respuesta = await fetch("{{ route('pna_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_persona_natural').modal('show');
                    document.getElementById('id_persona_natural').value = dato.mensaje.id;
                    document.getElementById('ci_').value                = dato.mensaje.ci;
                    document.getElementById('expedido_').value          = dato.mensaje.id_expedido;
                    document.getElementById('complemento_').value          = dato.mensaje.complemento;
                    document.getElementById('nombres_').value          = dato.mensaje.nombres;
                    document.getElementById('apellido_paterno_').value          = dato.mensaje.apellido_paterno;
                    document.getElementById('apellido_materno_').value          = dato.mensaje.apellido_materno;
                    document.getElementById('genero_').value          = dato.mensaje.genero;
                    document.getElementById('estado_civil_').value          = dato.mensaje.estado_civil;
                    document.getElementById('email_persona_').value          = dato.mensaje.email;
                    document.getElementById('celular_persona_').value          = dato.mensaje.celular;
                    document.getElementById('numero_referencia_').value          = dato.mensaje.celular_referencia;
                    document.getElementById('direccion_').value          = dato.mensaje.direccion;
                    document.getElementById('informacion_adicional_').value          = dato.mensaje.informacion_adicional;

                    //para mostrar los seleccionados de select 2 de profesiones
                    let profeciones_edi = dato.mensaje.profesion;
                    let array1 = [];
                    profeciones_edi.forEach(valor=>{
                        array1.push(valor.id)
                    });
                    $('#profesion_edi').val(array1).trigger('change');
                    //fin de la parte de seleccionar de select 2 de profesiones

                    let selectElement = document.getElementById('zona_');
                    selectElement.value = dato.mensaje.id_zona;
                    selectElement.dispatchEvent(new Event('change'));
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar lo editado de la persona natural
        let guardar_persona_natural_editado = document.getElementById('btn_guardar_persona_natural_editado');
        guardar_persona_natural_editado.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_persona_natural')).entries());
            //para seleccionar profesiones
            let profesion_edi = [];
            let seleccion_profesiones = document.querySelectorAll('select[name="profesion_edi[]"] option:checked');
            seleccion_profesiones.forEach(function (option) {
                profesion_edi.push(option.value);
            });
            try {
                let respuesta = await fetch("{{ route('pna_update') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        id                  : datos.id_persona_natural,
                        complemento_        : datos.complemento_,
                        expedido_           : datos.expedido_,
                        nombres_            : datos.nombres_,
                        apellido_paterno_   : datos.apellido_paterno_,
                        apellido_materno_   : datos.apellido_materno_,
                        genero_             : datos.genero_,
                        estado_civil_       : datos.estado_civil_,
                        profesion_edi       : profesion_edi,
                        email_persona_      : datos.email_persona_,
                        celular_persona_    : datos.celular_persona_,
                        numero_referencia_  : datos.numero_referencia_,
                        zona_               : datos.zona_,
                        direccion_          : datos.direccion_,
                        informacion_adicional_: datos.informacion_adicional_
                    })
                });
                let dato = await respuesta.json();
                vaciar_errores_natural();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_per_natural').fadeOut(200, function() {
                        $('#listar_per_natural').DataTable().destroy();
                        listar_persona_natural();
                        cerrar_modal_persona_natural();
                        $('#modal_editar_persona_natural').modal('hide');
                        $('#listar_per_natural').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para eliminar la persona natural
        async function eliminar_persona_natural(id){
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
                    let respuesta = await fetch("{{ route('pna_delete') }}", {
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
                        $('#listar_per_natural').fadeOut(200, function() {
                            $('#listar_per_natural').DataTable().destroy();
                            listar_persona_natural();
                            $('#modal_nueva_persona_natural').modal('hide');
                            $('#listar_per_natural').fadeIn(200);
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

        //para vizualizar
        async function ver_persona_natural(id){
            try {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('_token', token);
                let response = await fetch("{{ route('pna_vizualizar') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    $('#modal_vizualizar_persona_natural').modal('show');
                    document.getElementById('vizualizar_persona_natural').innerHTML = data;
                } else {
                    console.error("Error en la solicitud :", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
    </script>
@endsection
