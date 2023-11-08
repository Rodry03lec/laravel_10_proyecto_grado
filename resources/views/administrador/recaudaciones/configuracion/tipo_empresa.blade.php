@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| TIPO DE EMPRESA')
@section('contenido_recaudaciones')

    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
        <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
            <a href="index.html">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
            </a>
        </li>
        <li class="inline-block relative text-sm text-primary-500 font-Inter ">
            Configuración
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
        </li>
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Tipo de empresa</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Tipo de empresa</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nuevo_tipo_empresa">
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
                                    <th scope="col" class="table-th">TITULO</th>
                                    <th scope="col" class="table-th">DESCRIPCIÓN</th>
                                    <th scope="col" class="table-th">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="listar_tipo_empresa_tab">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA CREAR EXPEDIDO --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nuevo_tipo_empresa" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Tipo de empresa
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="vaciar_campos_tipo_empresa()">
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
                        <form method="POST" id="form_nuevo_tipo_empresa" autocomplete="off">
                            @csrf
                            <div class="input-area">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input id="titulo" name="titulo" type="text" class="form-control" placeholder="Ingrese el titulo" >
                                <div id="_titulo"></div>
                            </div>
                            <div class="input-area">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="3"></textarea>
                                <div id="_descripcion"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_tipo_empresa" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CREAR EXPEDIDO --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_tipo_empresa" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Editar tipo de empresa
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="vaciar_campos_tipo_empresa()">
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
                        <form method="POST" id="form_editar_tipo_empresa" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id_tipo_empresa" id="id_tipo_empresa" >
                            <div class="input-area">
                                <label for="titulo_" class="form-label">Titulo</label>
                                <input id="titulo_" name="titulo_" type="text" class="form-control" placeholder="Ingrese el titulo" >
                                <div id="_titulo_"></div>
                            </div>
                            <div class="input-area">
                                <label for="descripcion_" class="form-label">Descripción</label>
                                <textarea name="descripcion_" id="descripcion_" class="form-control" cols="30" rows="3"></textarea>
                                <div id="_descripcion_"></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_tipo_empresa_edit" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script_recaudaciones')
    <script>
        //para listar la parte de tipo de zonas
        async function listar_tipo_empresa(){
            try {
                let respuesta = await fetch("{{ route('tem_listar') }}", {
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
                        cuerpo += "<td class='table-td' >" + datos[key]['titulo'] + "</td>";
                        cuerpo += "<td class='table-td' >" + datos[key]['descripcion'] + "</td>";

                        cuerpo += `<td class="table-td" >
                            <div class="flex space-x-3 rtl:space-x-reverse">
                                <button class="action-btn btn-warning" onclick="editar_tipo_empresa('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                </button>
                                <button class="action-btn btn-danger" onclick="eliminar_tipo_empresa('${datos[key]['id']}')" type="button">
                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                </button>
                            </div>
                        </td>`;
                        cuerpo += '</tr>';
                    }
                    document.getElementById('listar_tipo_empresa_tab').innerHTML = cuerpo;
                } else {
                    console.log(data.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
        listar_tipo_empresa();

        //para vaciar los campos
        function vaciar_campos_tipo_empresa(){
            limpiar_campos('form_nuevo_tipo_empresa');
            vaciar_errores_tipo_empresa();
        }
        //vaciar los errores expedido
        function vaciar_errores_tipo_empresa(){
            let valores = ['_titulo','_descripcion', '_titulo_','_descripcion_'];
            valores.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }

        //para crear un nuevo expedido
        let guardar_tipo_empresa_btn = document.getElementById('btn_guardar_tipo_empresa');
        guardar_tipo_empresa_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nuevo_tipo_empresa')).entries());
            try {
                let respuesta = await fetch("{{ route('tem_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_tipo_empresa();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_tipo_empresa();
                    $('#modal_nuevo_tipo_empresa').modal('hide');
                    vaciar_campos_tipo_empresa();
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });

        //para eliminar el tipo de empresa
        function eliminar_tipo_empresa(id){
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
                    let respuesta = await fetch("{{ route('tem_eliminar') }}", {
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
                        listar_tipo_empresa();
                    }
                    if (dato.tipo === 'error') {
                        alerta_top(dato.tipo, dato.mensaje);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    alerta_top('error', 'Se cancelo');
                }
            })
        }

        //para editar el tipo de empresa
        async function editar_tipo_empresa(id) {
            vaciar_errores_tipo_empresa();
            try {
                let respuesta = await fetch("{{ route('tem_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_tipo_empresa').modal('show');
                    document.getElementById('id_tipo_empresa').value    = dato.mensaje.id;
                    document.getElementById('titulo_').value         = dato.mensaje.titulo;
                    document.getElementById('descripcion_').value   = dato.mensaje.descripcion;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar el tipo de empresa editado
        let guardar_tipo_empresa_edit_btn = document.getElementById('btn_guardar_tipo_empresa_edit');
        guardar_tipo_empresa_edit_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_tipo_empresa')).entries());
            try {
                let respuesta = await fetch("{{ route('tem_editar_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_tipo_empresa();
                if (dato.tipo === 'errores') {
                    let obj = dato.mensaje;
                    for (let key in obj) {
                        document.getElementById('_' + key).innerHTML = `<p id="error_estilo" >` + obj[key] +`</p>`;
                    }
                }
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, dato.mensaje);
                    listar_tipo_empresa();
                    $('#modal_editar_tipo_empresa').modal('hide');
                    vaciar_campos_tipo_empresa();
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        });
    </script>
@endsection
