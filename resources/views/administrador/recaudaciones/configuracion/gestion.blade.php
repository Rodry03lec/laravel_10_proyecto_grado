@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| GESTIÓN')
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
                Configuración
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
            </li>
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Listar Gestión</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Gestión</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nuevo_gestion">
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
                        <table id="tabla_categoria" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                            style="width: 100%">
                            <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                <tr>
                                    <th scope="col" class="table-th">ID</th>
                                    <th scope="col" class="table-th">GESTIÓN</th>
                                    <th scope="col" class="table-th">categoría</th>
                                    <th scope="col" class="table-th">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listar_gestion as $lis)
                                <tr>
                                    <td  class="table-td">{{ $loop->iteration }}</td>
                                    <td  class="table-td">{{ $lis->gestion }}</td>
                                    <td  class="table-td">
                                        <button class="btn inline-flex justify-center btn-primary btn-sm" onclick="listar_categoria('{{ $lis->id }}')">
                                            <span class="flex items-center">
                                            <span>categoría</span>
                                            </span>
                                        </button>
                                    </td>
                                    <td  class="table-td">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <button class="action-btn btn-warning" onclick="editar_gestion('{{ $lis->id }}')" type="button">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </button>
                                            <button class="action-btn btn-danger" onclick="eliminar_gestion('{{ $lis->id }}')" type="button">
                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
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

    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nuevo_gestion" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Nueva Gestión
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_gestion_validar()">
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
                        <form method="POST" id="form_nueva_gestion" autocomplete="off">
                            @csrf
                            <div class="input-area">
                                <label for="gestion" class="form-label">Ingrese una nueva gestión</label>
                                <input id="gestion" name="gestion" type="text" class="form-control" placeholder="Ingrese una gestión" onkeypress="return soloNumeros(event)" maxlength="4">
                                <div id="_gestion"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_gestion" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA EDITAR LA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_gestion" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Editar Gestión
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_gestion_validar()">
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
                        <form method="POST" id="form_editar_gestion" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id_gestion" id="id_gestion">
                            <div class="input-area">
                                <label for="gestion_" class="form-label">Ingrese una nueva gestión</label>
                                <input id="gestion_" name="gestion_" type="text" class="form-control" placeholder="Ingrese una gestión" onkeypress="return soloNumeros(event)" maxlength="4">
                                <div id="_gestion_"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_gestion_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_listar_categoria" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog modal-xl  relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Registrar categoria y sus precios
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_categoria_formulario()">
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
                        <form method="POST" id="form_nuevo_categoria" autocomplete="off">
                            @csrf
                            <input type="hidden" id="id_categoria" name="id_categoria">
                            <input type="hidden" id="id_ges" name="id_ges">
                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-3 xl:grid-cols-3 gap-7">
                                <div class="input-area relative">
                                    <label for="nombre_categoria" class="form-label">Nombre de la Categoria</label>
                                    <input id="nombre_categoria" name="nombre_categoria" type="text" class="form-control"
                                        placeholder="Ingrese una categoria">
                                    <div id="_nombre_categoria"></div>
                                </div>
                                <div class="input-area relative">
                                    <label for="precio_fijo" class="form-label">Precio Fijo</label>
                                    <input id="precio_fijo" name="precio_fijo" type="text" class="form-control monto_number" placeholder="Ingrese el precio fijo 00.00">
                                    <div id="_precio_fijo"></div>
                                </div>

                                <div class="input-area py-6 text-center">
                                    <button type="button" id="btn_guardar_categoria" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body px-6 pb-6">
                            <div class="inline-block min-w-full align-middle" >
                                <div class="overflow-hidden ">
                                    <table id="tabla_categoria" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                        style="width: 100%">
                                        <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                            <tr>
                                                <th class="table-th">ID</th>
                                                <th scope="col" class="table-th">NOMBRE CATEGORIA</th>
                                                <th scope="col" class="table-th">PRECIO FIJO</th>
                                                <th scope="col" class="table-th">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mostrar_vista_categoria" >

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

@endsection

@section('script_recaudaciones')
    <script>
        //para vaciar los errores
        function cerrar_modal_gestion_validar(){
            limpiar_campos('form_nueva_gestion');
            limpiar_campos('form_editar_gestion');
            vaciar_errores_gestion();
        }
        //para vaciar los errores
        function vaciar_errores_gestion(){
            document.getElementById('_gestion').innerHTML = '';
            document.getElementById('_gestion_').innerHTML = '';
        }
        //para guardar la gestion
        let guardar_gestion_btn = document.getElementById('btn_guardar_gestion');
        guardar_gestion_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nueva_gestion')).entries());
            try {
                let respuesta = await fetch("{{ route('gestion_crear') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_gestion();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    setTimeout(() => {
                        location.reload();
                    }, 1600);
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });
        //para editar la gestion
        async function editar_gestion(id){
            vaciar_errores_gestion();
            try {
                let respuesta = await fetch("{{ route('gestion_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_gestion').modal('show');
                    document.getElementById('id_gestion').value = dato.mensaje.id;
                    document.getElementById('gestion_').value = dato.mensaje.gestion;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
        //para guardar la gestión
        let guardar_gestion_editado_btn = document.getElementById('btn_guardar_gestion_editado');
        guardar_gestion_editado_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_gestion')).entries());
            try {
                let respuesta = await fetch("{{ route('gestion_editar_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_gestion();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    setTimeout(() => {
                        location.reload();
                    }, 1600);
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para eliminar la gestion
        function eliminar_gestion(id){
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
                    let respuesta = await fetch("{{ route('gestion_eliminar') }}", {
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
                        setTimeout(() => {
                            location.reload();
                        }, 1600);
                    }
                    if (dato.tipo === 'error') {
                        alerta_top(dato.tipo, dato.mensaje);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        }

        //PARA LA PARTE DE LA CATEGORIA
        async function listar_categoria(id){
            try {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('_token', token);
                let response = await fetch("{{ route('categoria_listar') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    vaciar_errores_gestion();
                    $('#modal_listar_categoria').modal('show');
                    document.getElementById('id_ges').value = id;
                    document.getElementById('mostrar_vista_categoria').innerHTML = data;
                } else {
                    console.error("Error en la solicitud AJAX:", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para cerrar el modal de categoria
        function cerrar_modal_categoria_formulario(){
            limpiar_campos('form_nuevo_categoria');
        }
        function vaciar_errores_categoria(){
            document.getElementById('_nombre_categoria').innerHTML = '';
            document.getElementById('_precio_fijo').innerHTML = '';
        }

        //para guardar la categoria segun la gestión
        let guardar_categoria_btn = document.getElementById('btn_guardar_categoria');
        guardar_categoria_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nuevo_categoria')).entries());
            document.getElementById('id_categoria').value = '';
            try {
                let respuesta = await fetch("{{ route('categoria_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_categoria();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_categoria(dato.id_ges);
                    cerrar_modal_categoria_formulario();
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para editarla categoria
        async function editar_categoria(id){
            try {
                let respuesta = await fetch("{{ route('categoria_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    document.getElementById('id_categoria').value       = dato.id_categoria;
                    document.getElementById('nombre_categoria').value   = dato.nombre_cat;
                    document.getElementById('precio_fijo').value        = dato.precio_fijo_cat;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para editarla categoria
        async function eliminar_categoria(id){
            let id_gestion = document.getElementById('id_ges').value;
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
                    try {
                        let respuesta = await fetch("{{ route('categoria_eliminar') }}", {
                            method: "DELETE",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({id:id})
                        });
                        let dato = await respuesta.json();
                        if (dato.tipo === 'success') {
                            alerta_top(dato.tipo, dato.mensaje);
                            listar_categoria(id_gestion);
                            cerrar_modal_categoria_formulario();
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


        }
    </script>
@endsection
