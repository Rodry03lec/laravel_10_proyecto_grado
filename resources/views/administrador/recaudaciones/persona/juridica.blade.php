@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| JURIDICA')
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
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Persona jurídica</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Listado de Persona jurídica</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_persona_juridica">
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
                    <div class="overflow-hidden w-full overflow-x-auto">
                        <table id="listar_per_juridica" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700 table-auto {{-- data-table --}}"
                            style="width: 100%">
                            <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                <tr>
                                    <th scope="col" class="table-th ">ID</th>
                                    <th scope="col" class="table-th">NOMBRE EMPRESA</th>
                                    <th scope="col" class="table-th">EMAIL</th>
                                    <th scope="col" class="table-th">TELEFONO</th>
                                    <th scope="col" class="table-th">CELULAR</th>
                                    <th scope="col" class="table-th">NIT</th>
                                    <th scope="col" class="table-th">NÚMERO DE TESTIMONIO</th>
                                    <th scope="col" class="table-th">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA CREAR LA NUEVA PERSONA NATURAL --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nueva_persona_juridica" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
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
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_persona_juridica()">
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
                        <form method="POST" id="form_nueva_persona_juridica" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_repre" name="id_repre">
                            <fieldset>
                                <legend>PERSONA</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                    <div class="input-area relative">
                                        <label for="tipo_empresa" class="form-label">SELECCIONE EL TIPO DE EMPRESA</label>
                                        <select name="tipo_empresa" id="tipo_empresa" class="select2_uno form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione el tipo de empresa" >
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione el tipo de empresa]</option>
                                            @foreach ($tipo_empresa as $lis)
                                                <option value="{{ $lis->id }}">[{{ $lis->titulo }}] : {{ $lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_tipo_empresa"></div>
                                    </div>



                                    <div class="input-area relative">
                                        <label for="id_representante_legal" class="form-label">REPRESENTANTE LEGAL</label>
                                        <input id="id_representante_legal" name="id_representante_legal" type="text" class="form-control" maxlength="10" placeholder="Ingrese ci del representante legal" onkeyup="buscar_ci_natural(this.value)"  onkeypress="return soloNumeros(event)">
                                        <div id="_id_representante_legal"></div>

                                        <div class=" py-2 space-y-5" id="ver_representante_legal">

                                        </div>
                                    </div>

                                    {{-- <div class="input-area relative">
                                        <label for="id_asesor" class="form-label">ASESOR</label>
                                        <input id="id_asesor" name="id_asesor" type="text" class="form-control" placeholder="Ingrese ci del asesor">
                                        <div id="_id_asesor"></div>

                                        <div class=" py-2 space-y-5">
                                            <div class="alert alert-outline-primary ">
                                                <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                                    <div class="flex-1 font-Inter">
                                                    This is an alert—check it out!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </fieldset>


                            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                <fieldset>
                                    <legend>DOCUMENTOS</legend>

                                    <div class="input-area relative">
                                        <label for="actividad_economica" class="form-label">DESCRIPCIÓN DE LA ACTIVIDAD ECONOMICA</label>
                                        <textarea id="actividad_economica" name="actividad_economica" cols="30" rows="2" class="form-control" placeholder="Describa la actividad economica"  @disabled(true)></textarea>
                                        <div id="_actividad_economica"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="numero_testimonio" class="form-label">NÚMERO DE TESTIMONIO</label>
                                        <input id="numero_testimonio" name="numero_testimonio" type="text" class="form-control" placeholder="Ingrese el número de testionio" @disabled(true) >
                                        <div id="_numero_testimonio"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="testimonio" class="form-label">SELECCIONE EL TESTIMONIO</label>
                                        <input id="testimonio" name="testimonio" type="file" class="form-control" accept=".pdf"  placeholder="Seleccione el testimonio" @disabled(true)>
                                        <div id="_testimonio"></div>
                                    </div>
                                    <div class="flex justify-center items-center py-2">
                                        <embed id="vizualizar_pdf" type="application/pdf" class="rounded-md border-4 border-slate-200 block" width="350" height="350">
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>INFORMACIÓN</legend>
                                    <div class="input-area relative">
                                        <label for="nit" class="form-label">NIT</label>
                                        <input id="nit" name="nit" type="text" class="form-control" placeholder="Ingrese el nº de NIT" @disabled(true)>
                                        <div id="_nit"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="nombre" class="form-label">NOMBRE DE LA EMPRESA</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese el nombre de la empresa" @disabled(true)>
                                        <div id="_nombre"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="telefono" class="form-label">Nº TELEFONO</label>
                                        <input id="telefono" name="telefono" type="text" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Ingrese numero de telefono" @disabled(true)>
                                        <div id="_telefono"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="celular_empresa" class="form-label">Nº DE CELULAR</label>
                                        <input id="celular_empresa" name="celular_empresa" type="text" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Ingrese numero de celular" @disabled(true)>
                                        <div id="_celular_empresa"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="email_empresa" class="form-label">EMAIL</label>
                                        <input id="email_empresa" name="email_empresa" type="text" class="form-control" placeholder="Ingrese numero de celular" @disabled(true)>
                                        <div id="_email_empresa"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="fecha_constitucion" class="form-label">FECHA DE CONSTITUCIÓN</label>
                                        <input id="fecha_constitucion" name="fecha_constitucion" type="date" class="form-control" @disabled(true)>
                                        <div id="_fecha_constitucion"></div>
                                    </div>
                                </fieldset>
                            </div>

                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_persona_juridica" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR LA NUEVA PERSONA JURIDICA --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_persona_juridica" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Editar registro de persona Juridica
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_persona_juridica_editar()">
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
                        <form method="POST" id="form_editar_persona_juridica" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id_repre_edi" name="id_repre_edi">
                            <input type="hidden" id="id_persona_juridica" name="id_persona_juridica">
                            <fieldset>
                                <legend>PERSONA</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                    <div class="input-area relative">
                                        <label for="tipo_empresa_" class="form-label">SELECCIONE EL TIPO DE EMPRESA</label>
                                        <select name="tipo_empresa_" id="tipo_empresa_" class="select2_dos form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione el tipo de empresa" >
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione el tipo de empresa]</option>
                                            @foreach ($tipo_empresa as $lis)
                                                <option value="{{ $lis->id }}">[{{ $lis->titulo }}] : {{ $lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_tipo_empresa_"></div>
                                    </div>



                                    <div class="input-area relative">
                                        <label for="id_representante_legal_" class="form-label">REPRESENTANTE LEGAL</label>
                                        <input id="id_representante_legal_" name="id_representante_legal_" type="text" class="form-control" maxlength="10" placeholder="Ingrese ci del representante legal" onkeyup="buscar_ci_natural_editado(this.value)"  onkeypress="return soloNumeros(event)">
                                        <div id="_id_representante_legal_"></div>

                                        <div class=" py-2 space-y-5" id="ver_representante_legal_">

                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                <fieldset>
                                    <legend>DOCUMENTOS</legend>

                                    <div class="input-area relative">
                                        <label for="actividad_economica_" class="form-label">DESCRIPCIÓN DE LA ACTIVIDAD ECONOMICA</label>
                                        <textarea id="actividad_economica_" name="actividad_economica_" cols="30" rows="2" class="form-control" placeholder="Describa la actividad economica"></textarea>
                                        <div id="_actividad_economica_"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="numero_testimonio_" class="form-label">NÚMERO DE TESTIMONIO</label>
                                        <input id="numero_testimonio_" name="numero_testimonio_" type="text" class="form-control" placeholder="Ingrese el número de testionio">
                                        <div id="_numero_testimonio_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="testimonio_" class="form-label">SELECCIONE EL TESTIMONIO</label>
                                        <input id="testimonio_" name="testimonio_" type="file" class="form-control" accept=".pdf"  placeholder="Seleccione el testimonio">
                                        <div id="_testimonio_"></div>
                                    </div>
                                    <div class="flex justify-center items-center py-2">
                                        <embed id="vizualizar_pdf_" type="application/pdf" class="rounded-md border-4 border-slate-200 block" width="350" height="350">
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>INFORMACIÓN</legend>
                                    <div class="input-area relative">
                                        <label for="nit_" class="form-label">NIT</label>
                                        <input id="nit_" name="nit_" type="text" class="form-control" placeholder="Ingrese el nº de NIT">
                                        <div id="_nit_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="nombre_" class="form-label">NOMBRE DE LA EMPRESA</label>
                                        <input id="nombre_" name="nombre_" type="text" class="form-control" placeholder="Ingrese el nombre de la empresa">
                                        <div id="_nombre_"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="telefono_" class="form-label">Nº TELEFONO</label>
                                        <input id="telefono_" name="telefono_" type="text" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Ingrese numero de telefono">
                                        <div id="_telefono_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="celular_empresa_" class="form-label">Nº DE CELULAR</label>
                                        <input id="celular_empresa_" name="celular_empresa_" type="text" class="form-control" onkeypress="return soloNumeros(event)" placeholder="Ingrese numero de celular">
                                        <div id="_celular_empresa_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="email_empresa_" class="form-label">EMAIL</label>
                                        <input id="email_empresa_" name="email_empresa_" type="text" class="form-control" placeholder="Ingrese numero de celular">
                                        <div id="_email_empresa_"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="fecha_constitucion_" class="form-label">FECHA DE CONSTITUCIÓN</label>
                                        <input id="fecha_constitucion_" name="fecha_constitucion_" type="date" class="form-control">
                                        <div id="_fecha_constitucion_"></div>
                                    </div>
                                </fieldset>
                            </div>

                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_persona_juridica_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA VIZUALIZAR LA PWRSAONA JURIDICA --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_vizualizar_persona_juridica" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Vizualizar registro de persona Juridica
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
                    <div class="p-6 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto" {{-- id="scrollModal" --}} id="vizualizar_persona_juridica">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script_recaudaciones')
    <script>
        select2_uno('#modal_nueva_persona_juridica');
        select2_dos('#modal_editar_persona_juridica');
        //para validar datos si existe el representante legla

        //para cuando se cierre el modal se vacie los datos
        function cerrar_modal_persona_juridica(){
            limpiar_campos('form_nueva_persona_juridica');
            vaciar_select2_juridica();
            vaciar_errores_juridica();
            vaciar_pdf();
            desabilitar_habilitar_juridica(true);
            let ver_representante = document.getElementById('ver_representante_legal');
            ver_representante.innerHTML = '';
            let ci_error = document.getElementById('_id_representante_legal');
            ci_error.innerHTML = '';
        }

        //vacair los select2
        function vaciar_select2_juridica(){
            document.querySelectorAll('.select2_uno').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
        }

        //para vaciar los errores
        function vaciar_errores_juridica(){
            let per_juridica = ['_tipo_empresa', '_numero_testimonio', '_testimonio', '_nit', '_nombre', '_telefono', '_celular_empresa', '_email_empresa', '_actividad_economica', '_fecha_constitucion'];
            per_juridica.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }

        //para habiliar o desabilitar los campos
        function desabilitar_habilitar_juridica(valor){
            let per_juridica = ['numero_testimonio', 'testimonio', 'nit', 'nombre', 'telefono', 'celular_empresa','actividad_economica', 'email_empresa', 'fecha_constitucion'];
            per_juridica.forEach(elem => {
                document.getElementById(elem).disabled = valor;
            });
            if(valor===true){
                per_juridica.forEach(elem => {
                    document.getElementById(elem).value = '';
                });
            }
        }

        //para validar si la persona esta registrada
        async function buscar_ci_natural(ci){
            let ci_error = document.getElementById('_id_representante_legal');
            let ver_representante = document.getElementById('ver_representante_legal');
            let id_repre = document.getElementById('id_repre');
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('pju_validar') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        desabilitar_habilitar_juridica(false);
                        id_repre.value = dato.mensaje[0].id;
                        ci_error.innerHTML  = `<p id="success_estilo" >Persona registrada</p>`;
                        ver_representante.innerHTML = `
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
                    }
                    if (dato.tipo === 'error') {
                        ci_error.innerHTML  = `<p id="error_estilo" >`+dato.mensaje+`</p>`;
                        desabilitar_habilitar_juridica(true);
                        ver_representante.innerHTML = '';
                        id_repre.value = '';
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                }
            }else{
                ci_error.innerHTML  = '';
                ver_representante.innerHTML = '';
                id_repre.value = '';
            }
        }

        //para guardar la persona juridica
        let guardar_persona_juridica_btn = document.getElementById('btn_guardar_persona_juridica');
        guardar_persona_juridica_btn.addEventListener('click', async ()=>{

            let form = document.getElementById('form_nueva_persona_juridica');
            let formData = new FormData(form);

            try {
                let respuesta = await fetch("{{ route('pju_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    body: formData
                });
                let dato = await respuesta.json();
                vaciar_errores_juridica();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_per_juridica').fadeOut(200, function() {
                        $('#listar_per_juridica').DataTable().destroy();
                        listar_persona_juridica();
                        cerrar_modal_persona_juridica();
                        $('#modal_nueva_persona_juridica').modal('hide');
                        $('#listar_per_juridica').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });


        //para cargar el pdf del testimonio
        document.querySelector('#testimonio').addEventListener('change', () => {
            let fileInput = document.querySelector('#testimonio');
            let file = fileInput.files[0];
            let error_mensaje = document.getElementById('_testimonio');
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    error_mensaje.innerHTML = `<p id="error_estilo" >El archivo supera el límite de tamaño permitido (2MB).</p>`;
                    fileInput.value = '';
                    return;
                }
                error_mensaje.innerHTML = '';
                // Verificar la extensión del archivo
                if (file.type !== 'application/pdf') {
                    error_mensaje.innerHTML = `<p id="error_estilo" >Por favor, seleccione un archivo PDF.</p>`;
                    this.value = '';
                    return;
                }
                error_mensaje.innerHTML = '';
                let pdfURL = URL.createObjectURL(file);
                document.querySelector('#vizualizar_pdf').setAttribute('src', pdfURL);
            }
        });

        //para vaciar el pdf
        function vaciar_pdf(){
            document.querySelector('#vizualizar_pdf').setAttribute('src', '');
            document.getElementById('testimonio').value = '';
        }

        //para listar los datos de la persona juridica
        async function listar_persona_juridica() {
            let respuesta = await fetch("{{ route('pju_listar') }}");
            let dato = await respuesta.json();
            let i = 1;
            $('#listar_per_juridica').DataTable({
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
                        data: 'nombre_empresa',
                        className: 'table-td'
                    },
                    {
                        data: 'email',
                        className: 'table-td'
                    },
                    {
                        data: 'telefono',
                        className: 'table-td'
                    },
                    {
                        data: 'celular',
                        className: 'table-td'
                    },
                    {
                        data: 'nit',
                        className: 'table-td'
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+ row.numero_testimonio+`</span>`;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `
                                <div class="flex space-x-3 items-center ">
                                    <button class=" action-btn btn-primary" onclick="ver_persona_juridica('${row.id}')" >
                                        <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-warning" onclick="editar_persona_juridica('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-danger" onclick="eliminar_persona_juridica('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        }
        listar_persona_juridica();


        //para eliminar la persona juridica
        async function eliminar_persona_juridica(id){
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
                    let respuesta = await fetch("{{ route('pju_delete') }}", {
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
                        $('#listar_per_juridica').fadeOut(200, function() {
                            $('#listar_per_juridica').DataTable().destroy();
                            listar_persona_juridica();
                            $('#modal_nueva_persona_juridica').modal('hide');
                            $('#listar_per_juridica').fadeIn(200);
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

        //PARA EDITAR LOS DATOS DEL LA PERSONA JURIDICA
        async function editar_persona_juridica(id){
            try {
                let respuesta = await fetch("{{ route('pju_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_persona_juridica').modal('show');
                    document.getElementById('id_persona_juridica').value = dato.mensaje.id;
                    console.log(dato);

                    //para completar el tipo de empresa
                    let selectElement = document.getElementById('tipo_empresa_');
                    selectElement.value = dato.mensaje.id_tipo_empresa;
                    selectElement.dispatchEvent(new Event('change'));
                    //para completar el tipo de empresa

                    document.getElementById('id_representante_legal_').value = dato.mensaje.representante_legal.ci;
                    document.getElementById('ver_representante_legal_').innerHTML = `
                        <div class="alert alert-outline-primary ">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    <dl class="list-none">
                                        <dt class="mb-1 font-bold">Nombres y apellidos : `+dato.mensaje.representante_legal.nombres+` `+dato.mensaje.representante_legal.apellido_paterno+` `+dato.mensaje.representante_legal.apellido_materno+ `</dt>
                                        <dd class="mb-1 font-bold"> Nº de celular : `+dato.mensaje.representante_legal.celular+`</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    `;

                    document.getElementById('actividad_economica_').value = dato.mensaje.actividad_economica;
                    document.getElementById('numero_testimonio_').value = dato.mensaje.numero_testimonio;

                    let urlDocumento = "{{ asset('testimonio/') }}/" + dato.mensaje.testimonio;
                    document.querySelector('#vizualizar_pdf_').setAttribute('src', urlDocumento);

                    document.getElementById('nit_').value = dato.mensaje.nit;
                    document.getElementById('nombre_').value = dato.mensaje.nombre_empresa;
                    document.getElementById('telefono_').value = dato.mensaje.telefono;
                    document.getElementById('celular_empresa_').value = dato.mensaje.celular;
                    document.getElementById('email_empresa_').value = dato.mensaje.email;
                    document.getElementById('fecha_constitucion_').value = dato.mensaje.fecha_constitucion;

                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }


        //para buscar la persona editado
        async function buscar_ci_natural_editado(ci){
            let ci_error = document.getElementById('_id_representante_legal_');
            let ver_representante = document.getElementById('ver_representante_legal_');
            let id_repre = document.getElementById('id_repre_edi');
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('pju_validar') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        id_repre.value = dato.mensaje[0].id;
                        ci_error.innerHTML  = `<p id="success_estilo" >Persona registrada</p>`;
                        ver_representante.innerHTML = `
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
                    }
                    if (dato.tipo === 'error') {
                        ci_error.innerHTML  = `<p id="error_estilo" >`+dato.mensaje+`</p>`;
                        ver_representante.innerHTML = '';
                        id_repre.value = '';
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                }
            }else{
                ci_error.innerHTML  = '';
                ver_representante.innerHTML = '';
                id_repre.value = '';
            }
        }

        //para guardar lo editado de la persona juridica
        let guardar_persona_juridica_editado = document.getElementById('btn_guardar_persona_juridica_editado');
        guardar_persona_juridica_editado.addEventListener('click', async ()=>{
            let form = document.getElementById('form_editar_persona_juridica');
            let formData = new FormData(form);
            try {
                let respuesta = await fetch("{{ route('pju_update') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    body: formData
                });
                let dato = await respuesta.json();
                console.log(dato);
                vaciar_errores_juridica();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_per_juridica').fadeOut(200, function() {
                        $('#listar_per_juridica').DataTable().destroy();
                        listar_persona_juridica();
                        cerrar_modal_persona_juridica_editar();
                        $('#modal_editar_persona_juridica').modal('hide');
                        $('#listar_per_juridica').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //par vaciar errores de editar
        function cerrar_modal_persona_juridica_editar(){
            limpiar_campos('form_editar_persona_juridica');

            document.querySelectorAll('.select2_dos').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
            vaciar_errores_editar_per_juridica();
            vaciar_pdf_edi();
        }

        function vaciar_errores_editar_per_juridica(){
            let per_juridica = ['_tipo_empresa_', '_numero_testimonio_', '_testimonio_', '_nit_', '_nombre_', '_telefono_', '_celular_empresa_', '_email_empresa_', '_actividad_economica_', '_fecha_constitucion_'];
            per_juridica.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }

        //para cargar el pdf del testimonio
        document.querySelector('#testimonio_').addEventListener('change', () => {
            let fileInput = document.querySelector('#testimonio_');
            let file = fileInput.files[0];
            let error_mensaje = document.getElementById('_testimonio_');
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    error_mensaje.innerHTML = `<p id="error_estilo" >El archivo supera el límite de tamaño permitido (2MB).</p>`;
                    fileInput.value = '';
                    return;
                }
                error_mensaje.innerHTML = '';
                // Verificar la extensión del archivo
                if (file.type !== 'application/pdf') {
                    error_mensaje.innerHTML = `<p id="error_estilo" >Por favor, seleccione un archivo PDF.</p>`;
                    this.value = '';
                    return;
                }
                error_mensaje.innerHTML = '';
                let pdfURL = URL.createObjectURL(file);
                document.querySelector('#vizualizar_pdf_').setAttribute('src', pdfURL);
            }
        });

        //para vaciar el pdf
        function vaciar_pdf_edi(){
            document.querySelector('#vizualizar_pdf_').setAttribute('src', '');
            document.getElementById('testimonio_').value = '';
        }

        //para ver detalles de persona juridica
        async function ver_persona_juridica(id){
            try {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('_token', token);
                let response = await fetch("{{ route('pju_vizualizar') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    $('#modal_vizualizar_persona_juridica').modal('show');
                    document.getElementById('vizualizar_persona_juridica').innerHTML = data;
                } else {
                    console.error("Error en la solicitud :", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
    </script>
@endsection
