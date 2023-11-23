@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| UNIDAD')
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
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Unidad</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Listado de unidad</h4>
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
                                    <th scope="col" class="table-th">Nº</th>
                                    <th scope="col" class="table-th">NOMBRE DE LA UNIDAD</th>
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


    {{-- MODAL PARA CREAR CARGO --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_listar_cargo" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Registrar cargos
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
                        <form method="POST" id="form_nuevo_cargo" autocomplete="off">
                            @csrf
                            <input type="hidden" id="id_uni" name="id_uni">
                            <input type="hidden" id="id_cargo" name="id_cargo">
                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-3 xl:grid-cols-3 gap-7">
                                <div class="input-area relative">
                                    <label for="cargo" class="form-label">Nombre del cargo</label>
                                    <input id="cargo" name="cargo" type="text" class="form-control"
                                        placeholder="Ingrese el nombre del cargo">
                                    <div id="_cargo"></div>
                                </div>

                                <div class="input-area relative">
                                    <label for="descripcion__" class="form-label">Descripción</label>
                                    <textarea name="descripcion__" class="form-control" id="descripcion__" placeholder="Ingrese la descripción del cargo" cols="30" rows="2"></textarea>

                                </div>

                                <div class="input-area py-6 text-center">
                                    <button type="button" id="btn_guardar_cargo" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                                </div>
                            </div>
                        </form>

                        <div class="card-body px-6 pb-6">
                            <div class="overflow-x-auto -mx-2 dashcode-data-table">
                                <div class="inline-block min-w-full align-middle" >
                                    <div class="overflow-hidden ">
                                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                            style="width: 100%">
                                            <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                                <tr>
                                                    <th class="table-th">Nº</th>
                                                    <th scope="col" class="table-th">CARGO</th>
                                                    <th scope="col" class="table-th">DESCRIPCIÓN</th>
                                                    <th scope="col" class="table-th">ACCIONES</th>
                                                </tr>
                                            </thead>
                                            <tbody id="mostrar_vista_cargo_tab" >

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

@endsection

@section('script_recaudaciones')
    <script>
        //para listar las unidades
        async function listar_unidad(){
            try {
                let respuesta = await fetch("{{ route('uni_listar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    let i = 1;
                    let datos = dato.mensaje;
                    let cuerpo = "";
                    for (let key in datos) {
                        cuerpo += '<tr>';
                        cuerpo += "<td class='table-td' >" + i++ + "</td>";
                        cuerpo += "<td class='table-td' >" + datos[key]['nombre'] + "</td>";
                        cuerpo += "<td class='table-td' >" + datos[key]['descripcion'] + "</td>";
                        cuerpo += `<td class="table-td" >
                            <button class="btn inline-flex justify-center btn-primary btn-sm" onclick="listar_cargos('${datos[key]['id']}')" >
                                <span class="flex items-center">
                                <span>Cargos</span>
                                </span>
                            </button>
                        </td>`;

                        cuerpo += `<td class="table-td" >
                            <div class="flex space-x-3 rtl:space-x-reverse">
                                <button class="action-btn btn-warning" onclick="editar_unidad('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                </button>
                                <button class="action-btn btn-danger" onclick="eliminar_unidad('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                </button>
                            </div>
                        </td>`;
                        cuerpo += '</tr>';
                    }
                    document.getElementById('tabla_cargos_tab').innerHTML = cuerpo;
                } else {
                    console.log(data.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
        listar_unidad();

        //para vaciar los inputs del formulario
        function cerrar_modal_cargo(){
            limpiar_campos('form_nueva_unidad');
            limpiar_campos('form_editar_unidad');
            limpiar_campos('form_nuevo_cargo');
            vaciar_errores_cargo();
        }
        //para vaciar los errores
        function vaciar_errores_cargo(){
            let errores_val = ['_nombre','_nombre_', '_cargo'];
            errores_val.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }

        //para guardar el cargo
        let guardar_unidad_btn = document.getElementById('btn_guardar_unidad');
        guardar_unidad_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nueva_unidad')).entries());
            try {
                let respuesta = await fetch("{{ route('uni_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_cargo();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_unidad();
                    cerrar_modal_cargo();
                    $('#modal_nueva_unidad').modal('hide');
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para eliminar el registro de la unidad
        function eliminar_unidad(id){
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
                    let respuesta = await fetch("{{ route('uni_eliminar') }}", {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({id:id})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        alerta_top(dato.tipo, dato.mensaje);
                        listar_unidad();
                        cerrar_modal_cargo();
                    }
                    if (dato.tipo === 'error') {
                        alerta_top(dato.tipo, dato.mensaje);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        }

        //para editar el registro
        async function editar_unidad(id){
            vaciar_errores_cargo();
            try {
                let respuesta = await fetch("{{ route('uni_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_unidad').modal('show');
                    document.getElementById('id_unidad').value = dato.mensaje.id;
                    document.getElementById('nombre_').value = dato.mensaje.nombre;
                    document.getElementById('descripcion_').value = dato.mensaje.descripcion;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar lo editado
        let guardar_unidad_editado_btn = document.getElementById('btn_guardar_unidad_editado');
        guardar_unidad_editado_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_unidad')).entries());
            try {
                let respuesta = await fetch("{{ route('uni_edi_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_cargo();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_unidad();
                    cerrar_modal_cargo();
                    $('#modal_editar_unidad').modal('hide');
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para la parte de los cargos
        async function listar_cargos(id){
            try {
                let respuesta = await fetch("{{ route('car_listar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body : JSON.stringify({id:id}),
                });
                let dato = await respuesta.json();
                $('#modal_listar_cargo').modal('show');
                document.getElementById('id_uni').value = id;
                if (dato.tipo === 'success') {
                    let i = 1;
                    let datos = dato.mensaje;
                    let cuerpo = "";
                    for (let key in datos) {
                        cuerpo += '<tr>';
                        cuerpo += "<td class='table-td' >" + i++ + "</td>";
                        cuerpo += "<td class='table-td' >" + datos[key]['nombre'] + "</td>";
                        cuerpo += "<td class='table-td' >" + datos[key]['descripcion'] + "</td>";

                        cuerpo += `<td class="table-td" >
                            <div class="flex space-x-3 rtl:space-x-reverse">
                                <button class="action-btn btn-warning" onclick="editar_cargo('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                </button>
                                <button class="action-btn btn-danger" onclick="eliminar_cargo('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                </button>
                            </div>
                        </td>`;
                        cuerpo += '</tr>';
                    }
                    document.getElementById('mostrar_vista_cargo_tab').innerHTML = cuerpo;
                } else {
                    console.log(data.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para crear nuevo cargo
        let guardar_cargo_btn = document.getElementById('btn_guardar_cargo');
        guardar_cargo_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nuevo_cargo')).entries());
            try {
                let respuesta = await fetch("{{ route('car_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_cargo();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_cargos(dato.id_unid);
                    cerrar_modal_cargo();
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para editar el cargo
        async function editar_cargo(id){
            vaciar_errores_cargo();
            try {
                let respuesta = await fetch("{{ route('car_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    document.getElementById('id_cargo').value = dato.mensaje.id;
                    document.getElementById('cargo').value = dato.mensaje.nombre;
                    document.getElementById('descripcion__').value = dato.mensaje.descripcion;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para eliminar el cargo
        function eliminar_cargo(id){
            let id_inidad = document.getElementById('id_uni').value;
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
                    let respuesta = await fetch("{{ route('car_eliminar') }}", {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({id:id})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        alerta_top(dato.tipo, dato.mensaje);
                        listar_cargos(id_inidad);
                    }
                    if (dato.tipo === 'error') {
                        alerta_top(dato.tipo, dato.mensaje);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        }
    </script>
@endsection
