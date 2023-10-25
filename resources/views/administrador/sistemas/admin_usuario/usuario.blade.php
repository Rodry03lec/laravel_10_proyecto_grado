@extends('menu.principal_sistemas')
@section('titulo_sistemas', '| USUARIOS')
@section('contenido_sistemas')
<div class="card">
    <div class="flex flex-wrap justify-between items-center mb-4">
        <header class="card-header noborder">
            <h4 class="card-title">Usuarios</h4>
        </header>
        <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
            <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal"
                data-bs-target="#modal_nuevo_usuario">
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
                <div class="overflow-hidden w-full overflow-x-auto ">
                    <table id="table_usuario" class="min-w-full table-auto divide-y divide-slate-100 dark:divide-slate-700 data-table" style="width: 100%">
                        <thead class=" bg-slate-200 dark:bg-slate-700 ">
                            <tr>
                                <th scope="col" class="table-th">ID</th>
                                <th scope="col" class="table-th">CI</th>
                                <th scope="col" class="table-th">NOMBRES Y APELLIDOS</th>
                                <th scope="col" class="table-th">CELULAR</th>
                                <th scope="col" class="table-th">EMAIL</th>
                                <th scope="col" class="table-th">ROLES</th>
                                <th scope="col" class="table-th">ESTADO</th>
                                <th scope="col" class="table-th">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $lis)
                                <tr>
                                    <td class="table-td">{{ $loop->iteration  }}</td>
                                    <td class="table-td">{{ $lis->ci }}</td>
                                    <td class="table-td">{{ $lis->nombres.' '.$lis->apellido_paterno.' '.$lis->apellido_materno }}</td>
                                    <td class="table-td">{{ $lis->celular }}</td>
                                    <td class="">{{ $lis->email }}</td>
                                    <td class="table-td">
                                        @if(!empty($lis->getRoleNames()))
                                            @foreach($lis->getRoleNames() as $rolNombre)
                                            <span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">{{ $rolNombre }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="table-td">
                                        <div class="form-check form-switch ">
                                            @if ($lis->estado=='activo')
                                                <span class="badge bg-success-500 text-success-500 bg-opacity-30 capitalize pill" style="cursor:pointer" onclick="estado_usuario('{{ $lis->id }}')">activo</span>
                                            @else
                                                <span class="badge bg-danger-500 text-danger-500 bg-opacity-30 capitalize pill" style="cursor:pointer" onclick="estado_usuario('{{ $lis->id }}')">inactivo</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="table-td">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            {{-- <button class="action-btn btn-success" onclick="estado_usuario('{{ $lis->id }}')" type="button">
                                                <iconify-icon icon="heroicons:arrow-path"></iconify-icon>
                                            </button> --}}
                                            <button class="action-btn btn-primary" onclick="reset_usuario('{{ $lis->id }}')" type="button">
                                                <iconify-icon icon="heroicons:lock-open"></iconify-icon>
                                            </button>
                                            <button class="action-btn btn-warning" onclick="editar_usuario('{{ $lis->id }}')" type="button">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </button>
                                            <button class="action-btn btn-danger" onclick="eliminar_usuario('{{ $lis->id }}')" type="button">
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



{{-- modal para nuevo usuario --}}
<div id="modal_nuevo_usuario" tabindex="-1" class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" data-bs-backdrop="static" x-data="{ showModal: false }">
    <div class="modal-dialog modal-md relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                Nuevo Usuario
                </h3>
                <button type="button"
                        class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                    dark:hover:bg-slate-600 dark:hover:text-white"
                        data-bs-dismiss="modal" onclick="cerrar_modal_usuario_validar()">
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
                <form method="POST" id="form_nuevo_usuario" autocomplete="off">
                    @csrf
                    <div class="input-area py-1">
                        <label for="ci" class="form-label">CI</label>
                        <input type="text" id="ci" name="ci" class="form-control" onkeyup="validar_ci(this.value)" placeholder="Ingrese CI">
                        <div id="_ci"></div>
                    </div>
                    <div class="input-area py-1">
                        <label for="nombres" class="form-label">Ingrese Nombres</label>
                        <input type="text" id="nombres" name="nombres"  class="form-control"
                            placeholder="Ingrese nombres" @disabled(true)>
                        <div id="_nombres"></div>
                    </div>
                    <div class="input-area py-1">
                        <label for="apellido_paterno" class="form-label">Ingrese Ap. Paterno </label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno"  class="form-control"
                            placeholder="Ingrese Apellido Paterno" @disabled(true)>
                        <div id="_apellido_paterno"></div>
                    </div>
                    <div class="input-area py-1">
                        <label for="apellido_materno" class="form-label">Ingrese Ap. Materno </label>
                        <input type="text" id="apellido_materno" name="apellido_materno"  class="form-control"
                            placeholder="Ingrese Apellido Materno" @disabled(true)>
                        <div id="_apellido_materno"></div>
                    </div>

                    <div class="py-2">
                        <label for="rol" class="form-label">Seleccione un Rol</label>
                        <select name="rol" id="rol" class="form-control w-full mt-2" @disabled(true)>
                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Seleccione un rol</option>
                            @foreach ($rol as $lis)
                                <option value="{{ $lis->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->name }}</option>
                            @endforeach
                        </select>
                        <div id="_rol" ></div>
                    </div>
                    <div class="input-area relative py-2">
                        <label for="usuario" class="form-label">Usuario</label>
                        <div class="relative">
                            <input type="text" name="usuario" id="usuario" class="form-control !pl-9" placeholder="Usuario" @disabled(true)>
                            <iconify-icon icon="heroicons-outline:user-circle" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                        </div>
                        <div id="_usuario" ></div>
                    </div>
                    <div class="input-area relative py-2">
                        <label for="password_" class="form-label">Contraseña</label>
                        <div class="relative">
                            <input type="text" name="password_" id="password_" class="form-control !pl-9" placeholder="Contraseña" @disabled(true)>
                            <iconify-icon icon="heroicons-outline:lock-closed" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                        </div>
                        <div id="_password_"></div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <button type="button" id="btn_guardar_usuario" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

{{-- modal para editar usuario --}}
<div id="modal_editar_usuario" tabindex="-1" class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" data-bs-backdrop="static" x-data="{ showModal: false }">
    <div class="modal-dialog modal-md relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                Editar Usuario
                </h3>
                <button type="button"
                        class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                    dark:hover:bg-slate-600 dark:hover:text-white"
                        data-bs-dismiss="modal" onclick="cerrar_modal_usuario_validar()">
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
                <form method="POST" id="form_editar_usuario" autocomplete="off">
                    @csrf
                    <input type="hidden" name="id_usuario" id="id_usuario">
                    <div class="input-area py-1">
                        <label for="nombres_" class="form-label">Ingrese Nombres</label>
                        <input type="text" id="nombres_" name="nombres_"  class="form-control"
                            placeholder="Ingrese nombres" >
                        <div id="_nombres_"></div>
                    </div>
                    <div class="input-area py-1">
                        <label for="apellido_paterno_" class="form-label">Ingrese Ap. Paterno </label>
                        <input type="text" id="apellido_paterno_" name="apellido_paterno_"  class="form-control"
                            placeholder="Ingrese Apellido Paterno" >
                        <div id="_apellido_paterno_"></div>
                    </div>
                    <div class="input-area py-1">
                        <label for="apellido_materno_" class="form-label">Ingrese Ap. Materno </label>
                        <input type="text" id="apellido_materno_" name="apellido_materno_"  class="form-control"
                            placeholder="Ingrese Apellido Materno" >
                        <div id="_apellido_materno_"></div>
                    </div>

                    <div class="py-2">
                        <label for="rol_" class="form-label">Seleccione un Rol</label>
                        <select name="rol_" id="rol_" class="form-control w-full mt-2" >
                            <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Seleccione un rol</option>
                            @foreach ($rol as $lis)
                                <option value="{{ $lis->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->name }}</option>
                            @endforeach
                        </select>
                        <div id="_rol_" ></div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <button type="button" id="btn_guardar_usuario_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>


{{-- modal para reset usuario y contraseña --}}
<div id="modal_reset_usuario" tabindex="-1" class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" data-bs-backdrop="static" x-data="{ showModal: false }">
    <div class="modal-dialog modal-md relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
        <div class="relative w-full h-full max-w-2xl md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                Reset Usuario
                </h3>
                <button type="button"
                        class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                    dark:hover:bg-slate-600 dark:hover:text-white"
                        data-bs-dismiss="modal" onclick="cerrar_modal_usuario_validar()">
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
                <form method="POST" id="form_reset_usuario" autocomplete="off">

                    <div class="alert alert-primary light-mode">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1" id="datos_personales">
                            </div>
                        </div>
                    </div>
                    @csrf
                    <input type="hidden" name="id_reset" id="id_reset">
                    <div class="input-area relative py-2">
                        <label for="usuario__" class="form-label">Usuario</label>
                        <div class="relative">
                            <input type="text" name="usuario__" id="usuario__" class="form-control !pl-9" placeholder="Usuario">
                            <iconify-icon icon="heroicons-outline:user-circle" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                        </div>
                        <div id="_usuario__" ></div>
                    </div>
                    <div class="input-area relative py-2">
                        <label for="password___" class="form-label">Contraseña</label>
                        <div class="relative">
                            <input type="text" name="password___" id="password___" class="form-control !pl-9" placeholder="Contraseña">
                            <iconify-icon icon="heroicons-outline:lock-closed" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                        </div>
                        <div id="_password___"></div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                <button type="button" id="btn_guardar_usuario_reset" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
@section('scripts_sistemas')
    <script>
        function vaciar_errores_nuevo_usuario(){
            let elementos = ['_ci','_nombres','_apellido_paterno', '_apellido_materno','_rol','_usuario','_password_'];
            elementos.forEach(elem => {
                document.getElementById(elem).innerHTML = '';
            });
        }
        //para celar el modal y vaciar los campos y los errores
        function cerrar_modal_usuario_validar(){
            limpiar_campos('form_nuevo_usuario');
            vaciar_errores_nuevo_usuario();
            deshabilitar_habilitar(true);
            vaciar_valores_usuario();
        }
        //para guardar los datos
        let guardar_usuario_btn = document.getElementById('btn_guardar_usuario');
        guardar_usuario_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nuevo_usuario')).entries());
            try {
                let respuesta = await fetch("{{ route('usuario_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
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
        //para validar el ci
        async function validar_ci(ci){
            let ci_error            = document.getElementById('_ci');
            let usuario_complet     = document.getElementById('usuario');
            let password_complet    = document.getElementById('password_');
            if(ci.length > 5){
                try {
                    let respuesta = await fetch("{{ route('usuario_validar') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify({ci:ci})
                    });
                    let dato = await respuesta.json();
                    if (dato.tipo === 'success') {
                        ci_error.innerHTML  = `<p id="error_estilo" > El ci ya fue registrado</p>`;
                        deshabilitar_habilitar(true);
                        vaciar_valores_usuario();
                        usuario_complet.value = '';
                        password_complet.value = '';
                    }
                    if (dato.tipo === 'error') {
                        deshabilitar_habilitar(false);
                        ci_error.innerHTML  = ``;
                        usuario_complet.value = 'us_'+ci;
                        password_complet.value = ci;
                    }
                } catch (error) {
                    console.log('Error de datos : ' + error);
                }
            }else{
                ci_error.innerHTML  = `<p id="error_estilo" > Debe ser mayor a 5 digitos</p>`;
                deshabilitar_habilitar(true);
                vaciar_valores_usuario();
                usuario_complet.value = '';
                password_complet.value = '';
            }
        }

        //para vaciar los campos y rellenar
        function deshabilitar_habilitar(valor){
            let elementos = ['nombres', 'apellido_paterno', 'apellido_materno', 'rol', 'usuario', 'password_'];
            elementos.forEach(elem => {
                document.getElementById(elem).disabled = valor;
            });
        }

        //para vaciar los campos
        function vaciar_valores_usuario(){
            let elementos = ['nombres', 'apellido_paterno', 'apellido_materno', 'usuario', 'password_'];
            elementos.forEach(elem => {
                document.getElementById(elem).value = '';
            });
            document.getElementById('rol').value = 'selected';
        }


        //para cambiar el estado del usuario
        function estado_usuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'NOTA!',
                text: "Esta seguro de cambiar el estado?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, cambiar',
                cancelButtonText: 'No, cancelar',
                reverseButtons: true
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let respuesta = await fetch("{{ route('usuario_estado') }}", {
                        method: 'POST',
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

        //para eliminar el usuario
        function eliminar_usuario(id){
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
                    let respuesta = await fetch("{{ route('usuario_eliminar') }}", {
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

        //para reset usuario y contraseña
        async function reset_usuario(id){
            try {
                let respuesta = await fetch("{{ route('usuario_reset') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_reset_usuario').modal('show');
                    document.getElementById('id_reset').value = dato.mensaje.id;
                    document.getElementById('datos_personales').innerHTML = `
                        <b class="block" >CI : `+dato.mensaje.ci+`</b>
                        <b class="block" >Usuario : `+dato.mensaje.nombres+` `+dato.mensaje.apellido_paterno+` `+dato.mensaje.apellido_materno+`</b>
                    `;
                    document.getElementById('usuario__').value = dato.mensaje.ci+'_RESET';
                    document.getElementById('password___').value = dato.mensaje.ci+'_RESET';
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para guardar usuario reset
        let guardar_usuario_reset_btn = document.getElementById('btn_guardar_usuario_reset');
        guardar_usuario_reset_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_reset_usuario')).entries());
            try {
                let respuesta = await fetch("{{ route('usuario_reset_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
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

        //para editar el usuario
        async function editar_usuario(id){
            try {
                let respuesta = await fetch("{{ route('usuario_reset') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    vaciar_modal_editado();
                    $('#modal_editar_usuario').modal('show');
                    document.getElementById('id_usuario').value         = dato.mensaje.id;
                    document.getElementById('nombres_').value           = dato.mensaje.nombres;
                    document.getElementById('apellido_paterno_').value  = dato.mensaje.apellido_paterno;
                    document.getElementById('apellido_materno_').value  = dato.mensaje.apellido_materno;
                    if(dato.mensaje.roles.length === 0){
                        document.getElementById('rol_').value = 'selected';
                    }else{
                        document.getElementById('rol_').value = dato.mensaje.roles[0].id;
                    }
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para vaciar los datos
        function vaciar_modal_editado(){
            limpiar_campos('form_editar_usuario');
        }

        //para guardar lo editado del usuario
        let guardar_usuario_editado_btn = document.getElementById('btn_guardar_usuario_editado');
        guardar_usuario_editado_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_usuario')).entries());
            try {
                let respuesta = await fetch("{{ route('usuario_editar_guardar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
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
