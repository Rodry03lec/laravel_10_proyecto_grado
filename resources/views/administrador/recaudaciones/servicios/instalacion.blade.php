@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| SERVICIO')
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
            Servicio
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
        </li>
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Instalación</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Instalacion de Servicio</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_registro_instalacion">
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
                        <table id="listar_instalacion_tab" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700 table-auto {{-- data-table --}}"
                            style="width: 100%">
                            <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                <tr>
                                    <th scope="col" class="table-th">ID</th>
                                    <th scope="col" class="table-th">TIPO</th>
                                    <th scope="col" class="table-th">CI REPRESENTANTE</th>
                                    <th scope="col" class="table-th">FECHA DE INSTALACIÓN</th>
                                    <th scope="col" class="table-th">MONTO (Bs)</th>
                                    <th scope="col" class="table-th">ESTADO_INSTALACIÓN</th>
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

    {{-- MODAL PARA CREAR la instalacion de servicio --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nueva_registro_instalacion" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Nuevo registro de Instalación
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_registro_instalacion()">
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
                        <form method="POST" id="form_nueva_instalacion" autocomplete="off" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="persona_natural_id" id="persona_natural_id">
                            <input type="hidden" name="persona_juridica_id" id="persona_juridica_id">

                            <fieldset>
                                <legend>INSTALACIÓN</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-7">
                                    <div class="input-area relative">
                                        <label for="ci_persona" class="form-label">INGRESE CI</label>
                                        <input name="ci_persona" id="ci_persona" class="form-control"  placeholder="Ingrese CI de la persona" onkeyup="buscar_ci_persona(this.value)">
                                        <div id="_ci_persona"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="persona_juridica" class="form-label">SELECCIONE</label>
                                        <select name="persona_juridica" id="persona_juridica" class="select2_cuarto form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la persona_juridica" onchange="seleccionar_persona_juridica(this.value)" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione persona juridica]</option>

                                        </select>
                                        <div id="_persona_juridica"></div>
                                    </div>
                                </div>
                            </fieldset>


                            <div id="mostar_datos_html">

                            </div>


                            <fieldset>
                                <legend>INSTALACIÓN</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 gap-7">
                                    <div class="input-area relative">
                                        <label for="zona" class="form-label">SELECCIONE LA FECHA DE INSTALACIÓN</label>
                                        <input type="date" name="fecha_instalacion" id="fecha_instalacion" class="form-control" placeholder="Seleccione la fecha de instalación" @disabled(true)>
                                        <div id="_fecha_instalacion"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="categoria" class="form-label">SELECCIONA LA CATEGORIA</label>
                                        {{-- {{ $categoria_listar }} --}}
                                        <select name="categoria" id="categoria" class=" form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la categoria" {{-- onchange="seleccione_categoria(this.value)" --}} @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione la categoria]</option>
                                            @foreach ($categoria_listar as $lis)
                                                <option value="{{ $lis->id }}">{{ $lis->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_categoria"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="sub_categoria" class="form-label">SELECCIONA LA SUB-CATEGORIA</label>
                                        <select name="sub_categoria" id="sub_categoria" class="select2_uno form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la categoria" onchange="monto_mostrar_categoria(this.value)" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione la categoría]</option>

                                        </select>
                                        <div id="_sub_categoria"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="monto_instalacion" class="form-label">INGRESE EL MONTO DE INSTALACIÓN</label>
                                        <input name="monto_instalacion" id="monto_instalacion" class="form-control monto_number"  placeholder="Ingrese el monto de instalación" @disabled(true)>
                                        <div id="_monto_instalacion"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="glosa" class="form-label">GLOSA</label>
                                        <textarea name="glosa" id="glosa" cols="30" rows="2" class="form-control"  placeholder="Describa la razón por la cual desea instalar el servicio" @disabled(true)></textarea>
                                        <div id="_glosa"></div>
                                    </div>


                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>DIRECCION</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 gap-7">

                                    <div class="input-area relative">
                                        <label for="propiedad" class="form-label">SELECCIONA LA PROPIEDAD</label>
                                        <select name="propiedad" id="propiedad" class="select2_dos form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la zona" @disabled(true)>
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione el tipo de propiedad]</option>
                                            @foreach ($propiedad as $lis)
                                                <option value="{{ $lis->id }}"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[{{ $lis->titulo }}] : {{ $lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_propiedad"></div>
                                    </div>

                                    <div class="input-area relative">
                                        <label for="zona" class="form-label">SELECCIONA LA ZONA</label>
                                        <select name="zona" id="zona" class="select2_tres form-control w-full mt-2 py-2 text-lg" aria-placeholder="Seleccione la zona" @disabled(true) >
                                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione la zona]</option>
                                            @foreach ($zonas as $lis)
                                                <option value="{{ $lis->id }}"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[{{ $lis->nombre }}] : {{ $lis->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        <div id="_zona"></div>
                                    </div>
                                    <div class="input-area relative">
                                        <label for="direccion" class="form-label">DIRECCIÓN DONDE SE HARA LA INSTALACIÓN</label>
                                        <textarea name="direccion" id="direccion" class="form-control" cols="30" rows="2" placeholder="Ingrese la direccion donde se realizara la instalacion" @disabled(true)></textarea>
                                        <div id="_direccion" ></div>
                                    </div>
                                </div>
                            </fieldset>


                        </form>
                    </div>
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_registro_instalacion" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_recaudaciones')
    <script>
       select2_uno('#modal_nueva_registro_instalacion');
        select2_dos('#modal_nueva_registro_instalacion');
        select2_tres('#modal_nueva_registro_instalacion');
        select2_cuatro('#modal_nueva_registro_instalacion');


        let mostrar_datos_persona_html = document.getElementById('mostar_datos_html');


        let categoria_select = document.getElementById('sub_categoria');
        //para cerrar el registro de instalacion
        function cerrar_modal_registro_instalacion(){
            limpiar_campos('form_nueva_instalacion');
            //para select categoria
            selecte2_valores();
            document.getElementById('persona_juridica').disabled = true;
            document.getElementById('persona_juridica').innerHTML = '<option selected disabled>[Seleccione persona juridica]</option>';
            categoria_select.innerHTML = '<option selected disabled>[Seleccione la categoria]</option>';
            //fin par select categoria

            desabilitar_habilitar_instalacion(true);
            mostrar_datos_persona_html.innerHTML = '';
            document.getElementById('_categoria').innerHTML='';
        }

        function selecte2_valores(){
            document.querySelectorAll('.select2_uno').forEach(select => {
                select.innerHTML = '<option selected disabled>[Seleccione la categoria]</option>';
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
            document.querySelectorAll('.select2_cuatro').forEach(select => {
                select.value = 'selected';
                select.dispatchEvent(new Event('change'));
            });
        }

        //para valicada si la persona esta registrada o no
        async function buscar_ci_persona(ci){
            let ci_error = document.getElementById('_ci_persona');
            let input_persona_natural = document.getElementById('persona_natural_id');
            let input_persona_juridica = document.getElementById('persona_juridica_id');
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('ins_validarp') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success'){
                        ci_error.innerHTML = '';
                        mostrar_datos_persona_html.innerHTML = `
                            <fieldset>
                                <legend>MOSTRAR DATOS</legend>
                                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
                                    <div class="alert alert-outline-primary ">
                                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                            <div class="flex-1 font-Inter">
                                                <dl class="list-none">
                                                    <dt class="mb-1 font-bold">Nombres y apellidos : `+dato.mensaje[0].nombres+` `+dato.mensaje[0].apellido_paterno+` `+dato.mensaje[0].apellido_materno+ `</dt>
                                                    <dd class="mb-1 font-bold"> Nº de celular : `+dato.mensaje[0].celular+`</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        `;

                        if(dato.mensaje[0].juridica_representante_legal.length > 0){
                            document.getElementById('persona_juridica').disabled = false;
                            let persona_g = dato.mensaje[0].juridica_representante_legal;
                            persona_g.forEach(value => {
                                $('#persona_juridica').append('<option value = "' + value.id + '">' + value.nombre_empresa + '</option>');
                            });
                            input_persona_natural.value = dato.mensaje[0].id;
                        }else{
                            input_persona_natural.value = dato.mensaje[0].id;
                            input_persona_juridica.value = '';
                        }

                        desabilitar_habilitar_instalacion(false);
                        categoria_select.innerHTML = '<option selected disabled>[Seleccione la categoría]</option>';
                    }
                    if (dato.tipo === 'error'){
                        mostrar_datos_persona_html.innerHTML = '';
                        document.getElementById('persona_juridica').disabled = true;

                        document.getElementById('persona_juridica').innerHTML = '<option selected disabled>[Seleccione persona juridica]</option>';
                        categoria_select.innerHTML = '<option selected disabled>[Seleccione la categoría]</option>';
                        ci_error.innerHTML = `<p id="error_estilo" >Persona no registrada</p>`;
                        desabilitar_habilitar_instalacion(true);
                        selecte2_valores();
                        input_persona_juridica.value = '';
                        input_persona_natural.value = '';
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                }
            }else{
                ci_error.innerHTML = '';
            }
        }

        //para validar que la persona es juridica
        function seleccionar_persona_juridica(id){
            let input_persona_juridica = document.getElementById('persona_juridica_id');
            input_persona_juridica.value = id;
            document.getElementById('persona_natural_id').value = '';

        }

        //para desabilitar y habilitar
        function desabilitar_habilitar_instalacion(valor){
            let valores = ['fecha_instalacion', 'categoria', 'sub_categoria','monto_instalacion', 'glosa', 'propiedad', 'zona', 'direccion'];
            valores.forEach(elem => {
                document.getElementById(elem).disabled = valor;
            });
        }



        async function seleccione_gestion(id){
            try {
                let respuesta = await fetch("{{ route('lisc_listar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                //para que elimine todo y en cero
                categoria_select.innerHTML = '<option selected disabled>[Seleccione la categoría]</option>';

                if (dato.tipo === 'success') {
                    let datos = dato.mensaje;
                    datos.forEach(value => {
                        let option = document.createElement('option');
                        option.value = value.id;
                        option.textContent = value.nombre;
                        categoria_select.appendChild(option);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        /* let select2_politica_desarrolloPDU = $('#gestion');
        select2_politica_desarrolloPDU.on('select2:select', function (e) {
            let id = select2_politica_desarrolloPDU.val();
            console.log(id);
        }); */

        //para mostrar el monto de la categoria
        async function monto_mostrar_categoria(id){
            if(!isNaN(id)){
                let categoria_err = document.getElementById('_categoria');
                try {
                    let respuesta = await fetch("{{ route('ins_listar_categoria') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({id:id})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        categoria_err.innerHTML = `
                        <div class="w-full h-64 flex items-center justify-center" >
                            <button class="btn inline-flex justify-center btn-success">
                                <iconify-icon class="text-xl spin-slow ltr:mr-2 rtl:ml-2 relative top-[1px]" icon="line-md:loading-twotone-loop"></iconify-icon>
                                <span>` + dato.mensaje.precio_fijo +` Bs.</span>
                            </button>
                        </div>`
                    }
                    if (dato.tipo === 'error') {
                        categoria_err.innerHTML = '';
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                }
            }

        }

        //para guardar los datos
        let guardar_registro_instalacion_btn = document.getElementById('btn_guardar_registro_instalacion');
        guardar_registro_instalacion_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nueva_instalacion')).entries());
            try {
                let respuesta = await fetch("{{ route('ins_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                console.log(dato);
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    $('#listar_instalacion_tab').fadeOut(200, function() {
                        $('#listar_instalacion_tab').DataTable().destroy();
                        listar_instalaciones();
                        cerrar_modal_registro_instalacion();
                        $('#modal_nueva_registro_instalacion').modal('hide');
                        $('#listar_instalacion_tab').fadeIn(200);
                    });
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });


        //para listar la parte de instalaciones
        async function listar_instalaciones(){
            let respuesta = await fetch("{{ route('ins_listar') }}");
            let dato = await respuesta.json();
            let i = 1;

            console.log(dato);
            $('#listar_instalacion_tab').DataTable({
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
                            if(row.id_persona_juridica !== null){
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">Juridica</span>`;
                            }else{
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">Natural</span>`;
                            }
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if(row.id_persona_juridica !== null){
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.persona_juridica.representante_legal.ci+`</span>`;
                            }else{
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.persona_natural.ci+`</span>`;
                            }
                        }
                    },
                    {
                        data: 'fecha_instalacion',
                        className: 'table-td'
                    },
                    {
                        data: 'monto_instalacion',
                        className: 'table-td'
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if(row.estado_instalacion == 'en_curso'){
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.estado_instalacion+`</span>`;
                            }else{
                                return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.estado_instalacion+`</span>`;
                            }
                        }
                    },
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

        listar_instalaciones();
    </script>
@endsection


