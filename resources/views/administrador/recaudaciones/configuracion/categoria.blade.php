@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| CATEGORÍA')
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
            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Categoría cobro de Agua</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Categoría de cobro de agua</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_categoria">
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
                                    <th scope="col" class="table-th">TIPO DE CONSUMO</th>
                                    <th scope="col" class="table-th">SUB CATEGORÍA</th>
                                    <th scope="col" class="table-th">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tabla_categoria_tab">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nueva_categoria" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Nueva Categoría
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_categoria()">
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
                        <form method="POST" id="form_nueva_categoria" autocomplete="off">
                            @csrf
                            <div class="input-area">
                                <label for="categoria" class="form-label">Ingrese una categoría</label>
                                <input id="categoria" name="categoria" type="text" class="form-control" placeholder="Ingrese una categoria" onkeypress="return soloLetras(event)">
                                <div id="_categoria"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_categoria" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA EDITAR LA CATEGORIA  --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_categoria" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Editar Categoría
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_categoria()">
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
                        <form method="POST" id="form_editar_categoria" autocomplete="off">
                            @csrf
                            <input type="hidden" id="id_cat" name="id_cat">
                            <div class="input-area">
                                <label for="categoria_" class="form-label">Ingrese una categoría</label>
                                <input id="categoria_" name="categoria_" type="text" class="form-control" placeholder="Ingrese una categoria" onkeypress="return soloLetras(event)">
                                <div id="_categoria_"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_categoria_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR LA NUEVA GESTION --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_listar_subcategoria" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
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
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="cerrar_modal_subcategoria_formulario()">
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
                        <form method="POST" id="form_nuevo_subcategoria" autocomplete="off">
                            @csrf
                            <input type="hidden" id="id_categoria" name="id_categoria">
                            <input type="hidden" id="id_sub_categoria" name="id_sub_categoria">
                            <div class="grid grid-cols-1 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-4 xl:grid-cols-4 gap-7">
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

                                <div class="input-area relative">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="2"></textarea>
                                    <div id="_descripcion"></div>
                                </div>

                                <div class="input-area py-6 text-center">
                                    <button type="button" id="btn_guardar_subcategoria" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body px-6 pb-6">
                            <div class="inline-block min-w-full align-middle" >
                                <div class="overflow-hidden ">
                                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                        style="width: 100%">
                                        <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                            <tr>
                                                <th class="table-th">ID</th>
                                                <th scope="col" class="table-th">NOMBRE CATEGORIA</th>
                                                <th scope="col" class="table-th">DESCRIPCIÓN</th>
                                                <th scope="col" class="table-th">PRECIO FIJO</th>
                                                <th scope="col" class="table-th">ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody id="mostrar_vista_subcategoria" >

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
        //para cerrar y vaciar el modal
        function cerrar_modal_categoria(){
            limpiar_campos('form_nueva_categoria');
            vaciar_errores_categoria();
            limpiar_campos('form_editar_categoria');
        }
        //para vaciar los errores
        function vaciar_errores_categoria(){
            document.getElementById('_categoria').innerHTML = '';
            document.getElementById('_categoria_').innerHTML = '';
        }

        //para listar las categorias
        async function listar_categorias(){
            try {
                let respuesta = await fetch("{{ route('cat_listar') }}", {
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
                        cuerpo += `<td class="table-td" >
                            <button class="btn inline-flex justify-center btn-primary btn-sm" onclick="listar_sub_categoria('${datos[key]['id']}')" >
                                <span class="flex items-center">
                                <span>Sub categoría</span>
                                </span>
                            </button>
                        </td>`;

                        cuerpo += `<td class="table-td" >
                            <div class="flex space-x-3 rtl:space-x-reverse">
                                <button class="action-btn btn-warning" onclick="editar_categoria('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                </button>
                                <button class="action-btn btn-danger" onclick="eliminar_categoria('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                </button>
                            </div>
                        </td>`;
                        cuerpo += '</tr>';
                    }
                    document.getElementById('tabla_categoria_tab').innerHTML = cuerpo;
                } else {
                    console.log(data.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
        listar_categorias();

        //para guardar la nueva categoria
        let guardar_categoria_btn = document.getElementById('btn_guardar_categoria');
        guardar_categoria_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nueva_categoria')).entries());
            try {
                let respuesta = await fetch("{{ route('cat_nuevo') }}", {
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
                    listar_categorias();
                    cerrar_modal_categoria();
                    $('#modal_nueva_categoria').modal('hide');
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para eliminar la categoria
        function eliminar_categoria(id){
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
                    let respuesta = await fetch("{{ route('cat_eliminar') }}", {
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
                        listar_categorias();
                    }
                    if (dato.tipo === 'error') {
                        alerta_top(dato.tipo, dato.mensaje);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        }

        //para editar la categoria
        async function editar_categoria(id){
            vaciar_errores_categoria();
            try {
                let respuesta = await fetch("{{ route('cat_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_categoria').modal('show');
                    document.getElementById('id_cat').value = dato.mensaje.id;
                    document.getElementById('categoria_').value = dato.mensaje.nombre;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar lo editado
        let guardar_categoria_editado_btn = document.getElementById('btn_guardar_categoria_editado');
        guardar_categoria_editado_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_categoria')).entries());
            try {
                let respuesta = await fetch("{{ route('cat_editar_gud') }}", {
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
                    listar_categorias();
                    $('#modal_editar_categoria').modal('hide');
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });


        //PARA LA PARTE DE LA SUBCATEGORIA
        async function listar_sub_categoria(id){
            try {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('_token', token);
                let response = await fetch("{{ route('casub_listar') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    vaciar_errores_categoria();
                    $('#modal_listar_subcategoria').modal('show');
                    document.getElementById('id_categoria').value = id;
                    document.getElementById('mostrar_vista_subcategoria').innerHTML = data;
                } else {
                    console.error("Error en la solicitud AJAX:", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

          //para cerrar el modal de categoria
        function cerrar_modal_subcategoria_formulario(){
            limpiar_campos('form_nuevo_subcategoria');
            vaciar_errores_subcategoria();
        }
        function vaciar_errores_subcategoria(){
            document.getElementById('_nombre_categoria').innerHTML = '';
            document.getElementById('_precio_fijo').innerHTML = '';
        }


        //para guardar el subcategoria
        let guardar_subcategoria_btn = document.getElementById('btn_guardar_subcategoria');
        guardar_subcategoria_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nuevo_subcategoria')).entries());
            document.getElementById('id_sub_categoria').value = '';
            try {
                let respuesta = await fetch("{{ route('casub_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_subcategoria();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_sub_categoria(dato.id_cate);
                    cerrar_modal_subcategoria_formulario();
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para editar sub categoria
        async function editar_sub_categoria(id){
            try {
                let respuesta = await fetch("{{ route('casub_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    document.getElementById('id_sub_categoria').value   = dato.id_sub_categoria_cat;
                    document.getElementById('nombre_categoria').value   = dato.nombre_cat;
                    document.getElementById('descripcion').value        = dato.descripcion_cat;
                    document.getElementById('precio_fijo').value        = dato.precio_fijo_cat;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para eliminar la subcategoria
        function eliminar_sub_categoria(id, id_categoria){
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
                    let respuesta = await fetch("{{ route('casub_eliminar') }}", {
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
                        listar_sub_categoria(id_categoria);
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
