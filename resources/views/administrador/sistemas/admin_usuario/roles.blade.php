@extends('menu.principal_sistemas')
@section('titulo_sistemas', '| ROLES')
@section('contenido_sistemas')

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">ROLES</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal"
                    data-bs-target="#modal_nuevo_permiso">
                    <span class="flex items-center">
                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                        <span>Nuevo</span>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div class=" space-y-5">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
            @foreach ($roles as $lis)
                <div class="card">
                    <div class="card-body p-6">
                        <div class="space-y-6">
                            <div class="flex space-x-3 items-center rtl:space-x-reverse">
                                <div class="flex-none h-8 w-8 rounded-full bg-slate-800 dark:bg-slate-700 text-slate-300 flex flex-col items-center  justify-center text-lg">
                                    <iconify-icon icon="heroicons:cog-solid"></iconify-icon>
                                </div>
                                <div class="flex-1 text-base text-slate-900 dark:text-white font-medium">
                                    {{ $lis->name }}
                                </div>
                            </div>
                            <div class="text-slate-600 dark:text-slate-300 text-sm">
                                <div>
                                    <ul class="space-y-3 p-6 rounded-md bg-slate-50 dark:bg-slate-700">

                                        @foreach ($lis->permissions as $i)
                                            <li class="text-sm text-slate-900 dark:text-slate-300 flex space-x-2 items-center rtl:space-x-reverse">
                                                <iconify-icon class="relative top-[2px]" icon="heroicons-outline:chevron-double-right"></iconify-icon>
                                                <span>{{ $i->name }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-2 flex items-center justify-center" >
                        <div class="card-text h-full">
                            <div class="btn-group-example btn-group">
                                <button onclick="editar_rol('{{ $lis->id }}')" class="btn inline-flex justify-center btn-primary shadow-base2 btn-sm">Editar</button>
                                <button onclick="eliminar_rol('{{ $lis->id }}')" class="btn inline-flex justify-center btn-danger shadow-base2 btn-sm">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nuevo_permiso" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Nuevo Rol
                        </h3>
                        <button type="button"
                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                        dark:hover:bg-slate-600 dark:hover:text-white"
                            data-bs-dismiss="modal" onclick="cerrar_modal_rol_validar()">
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
                        <form method="POST" id="form_nuevo_rol" autocomplete="off">
                            @csrf
                            <div class="input-area">
                                <label for="nombre_rol" class="form-label">Nombre del rol</label>
                                <input id="nombre_rol" name="nombre_rol" type="text" class="form-control"
                                    placeholder="Ingrese un rol">
                                <div id="_nombre_rol"></div>
                            </div>

                            <header class="flex mt-5 items-center text-center border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                <div class="flex-1">
                                    <div class="card-title text-slate-400 dark:text-white" style="font-size: 15px !important">Seleccione los Permisos</div>
                                </div>
                            </header>

                            @if ($permisos->isEmpty())
                                <div class="alert alert-danger light-mode">
                                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <iconify-icon class="text-2xl flex-0" icon="system-uicons:target"></iconify-icon>
                                        <p class="flex-1 font-Inter">
                                            ! No existe nigun permiso ¡
                                        </p>
                                    </div>
                                </div>
                            @else

                                <div class="card-text h-full space-y-4">
                                    <div class="flex items-center space-x-2 flex-wrap">
                                        <div class="checkbox-area">
                                            <label class="inline-flex items-center cursor-pointer" for="marcar_des">
                                                <input type="checkbox" class="hidden" id="marcar_des"  onclick="marcar_desmarcar(this);">
                                                <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                    <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Seleccionar todos</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <table class="table mt-4">
                                    <tbody>
                                        @forelse ($permisos as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="flex items-center space-x-2 flex-wrap">
                                                        <div class="checkbox-area primary-checkbox">
                                                            <label class="inline-flex items-center cursor-pointer" for="{{ $value->id }}">
                                                                <input type="checkbox" class="hidden" name="permisos[]" id="{{ $value->id }}" value="{{ $value->id }}">
                                                                <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                                                    <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                                                <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $value->name }}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                        -----
                                        @endforelse
                                    </tbody>
                                </table>
                            @endif
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_nuevo_rol"
                            class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_permiso" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            Editar Rol
                        </h3>
                        <button type="button"
                            class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                        dark:hover:bg-slate-600 dark:hover:text-white"
                            data-bs-dismiss="modal" onclick="cerrar_modal_rol_validar()">
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
                    <div class="p-6 space-y-4" id="view_editar_modal">

                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_editado_rol" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('scripts_sistemas')
    <script>
        //para marcar o desmarcar
        function marcar_desmarcar(source){
            let checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
            for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
                if(checkboxes[i].type == "checkbox"){//solo si es un checkbox entramos
                    checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
                }
            }
        }
        //para marcar o desmarcar para editar
        function marcar_desmarcar_edi(source){
            let checkboxes = document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
            for(i=0;i<checkboxes.length;i++){ //recoremos todos los controles
                if(checkboxes[i].type == "checkbox"){//solo si es un checkbox entramos
                    checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
                }
            }
        }

        /*PARA GUARDAR EL ROL CON SUS RESPECTIVOS PERMISOS*/
        let guardar_nuevo_rol_btn = document.getElementById('btn_guardar_nuevo_rol');
        guardar_nuevo_rol_btn.addEventListener('click', async ()=>{
            let nombre_rol = document.getElementById('nombre_rol').value;
            let permisos = [];
            let checkboxes = document.querySelectorAll('input[name="permisos[]"]:checked');
            checkboxes.forEach(function (checkbox) {
                permisos.push(checkbox.value);
            });
            try {
                let respuesta = await fetch("{{ route('rol_nuevo') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        nombre_rol : nombre_rol,
                        permisos : permisos
                    })
                });
                let dato = await respuesta.json();
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

        //para cerrar el modal
        function cerrar_modal_rol_validar(){
            limpiar_campos('form_nuevo_rol');
            vaciar_errores_rol();
        }
        //para vaciar los errores
        function vaciar_errores_rol(){
            document.getElementById('_nombre_rol').innerHTML = '';
        }

        //para eliminar el rol
        function eliminar_rol(id){
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
                    let respuesta = await fetch("{{ route('rol_eliminar') }}", {
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


        async function editar_rol(id) {
            try {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('_token', token);
                let response = await fetch("{{ route('rol_editar') }}", {
                    method: "POST",
                    body: formData
                });
                if (response.ok) {
                    let data = await response.text();
                    $('#modal_editar_permiso').modal('show');
                    document.getElementById('view_editar_modal').innerHTML = data;
                } else {
                    console.error("Error en la solicitud AJAX:", response.status);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar lo editado
        let guardar_editado_rol = document.getElementById('btn_guardar_editado_rol');
        guardar_editado_rol.addEventListener('click', async ()=>{
            let id = document.getElementById('id_rol').value;
            let nombre_rol_ = document.getElementById('nombre_rol_').value;
            let permisos = [];
            let checkboxes = document.querySelectorAll('input[name="permisos_edi[]"]:checked');
            checkboxes.forEach(function (checkbox) {
                permisos.push(checkbox.value);
            });
            try {
                let respuesta = await fetch("{{ route('rol_editar_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        id:id,
                        nombre_rol_ : nombre_rol_,
                        permisos : permisos
                    })
                });
                let dato = await respuesta.json();
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
    </script>
@endsection
