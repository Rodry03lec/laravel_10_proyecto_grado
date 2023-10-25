@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| ZONAS')
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
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Listar Zonas</li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Zonas</h4>
            </header>
            <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800 m-1" data-bs-toggle="modal" data-bs-target="#modal_nueva_zona">
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
                                    <th scope="col" class="table-th">NOMBRE</th>
                                    <th scope="col" class="table-th">DESCRIPCIÓN</th>
                                    <th scope="col" class="table-th">FECHA DE CREACIÓN</th>
                                    <th scope="col" class="table-th">TIPO DE ZONA</th>
                                    <th scope="col" class="table-th">ULTIMA MODIFICACIÓN</th>
                                    <th scope="col" class="table-th">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listar_zona as $lis)
                                    <tr>
                                        <td scope="col" class="table-td">{{ $loop->iteration }}</td>
                                        <td scope="col" class="table-td">{{ $lis->nombre }}</td>
                                        <td scope="col" class="table-td" style="width: 20%">{{ $lis->descripcion }}</td>
                                        <td scope="col" class="table-td">{{ fecha_literal($lis->fecha_creacion, 3) }}</td>
                                        <td scope="col" class="table-td">
                                            <span class="badge bg-success-500 text-primary-900 bg-opacity-30 capitalize pill" style="cursor:pointer">{{ $lis->relacion_tipo_zona[0]->nombre }}</span>
                                        </td>
                                        <td scope="col" class="table-td">{{ fecha_literal($lis->ultima_actualizacion, 3) }}</td>
                                        <td scope="col" class="table-td">
                                            <div class="flex space-x-3 rtl:space-x-reverse">
                                                <button class="action-btn btn-warning" onclick="editar_zona('{{ $lis->id }}')" type="button">
                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                </button>
                                                <button class="action-btn btn-danger" onclick="eliminar_zona('{{ $lis->id }}')" type="button">
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


    {{-- MODAL PARA CREAR ZONA --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_nueva_zona" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Nuevo zona
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="vaciar_valores_modal_zona()">
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
                        <form method="POST" id="form_nuevo_zona" autocomplete="off">
                            @csrf
                            <div class="input-area">
                                <label for="nombre" class="form-label">Ingrese nombre de la zona</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese tipo de zona" >
                                <div id="_nombre"></div>
                            </div>
                            <div class="input-area">
                                <label for="descripcion" class="form-label">Descripcion de la zona</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="2"></textarea>
                                <div id="_descripcion"></div>
                            </div>

                            <div class="input-area">
                                <label for="fecha_creacion" class="form-label">Fecha de creación</label>
                                <input id="fecha_creacion" name="fecha_creacion" type="date" max="{{ date('Y-m-d') }}" class="form-control" >
                                <div id="_fecha_creacion"></div>
                            </div>

                            <div class="py-2">
                                <label for="tipo_zona" class="form-label">Seleccione el tipo de Zona</label>
                                <select name="tipo_zona" id="tipo_zona" class="form-control w-full mt-2">
                                    <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Seleccione un tipo de Zona</option>
                                    @foreach ($tipo_zona as $lis)
                                        <option value="{{ $lis->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->nombre }}</option>
                                    @endforeach
                                </select>
                                <div id="_tipo_zona" ></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_zona" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA CREAR ZONA --}}
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="modal_editar_zona" tabindex="-1" aria-labelledby="disabled_backdrop" aria-hidden="true"
    data-bs-backdrop="static" x-data="{ showModal: false }">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white">
                            Editar zona
                        </h3>
                        <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal" onclick="vaciar_valores_modal_zona()">
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
                        <form method="POST" id="form_editar_zona" autocomplete="off">
                            @csrf
                            <input type="hidden" name="id_zona" id="id_zona">
                            <div class="input-area">
                                <label for="nombre_" class="form-label">Ingrese nombre de la zona</label>
                                <input id="nombre_" name="nombre_" type="text" class="form-control" placeholder="Ingrese tipo de zona" >
                                <div id="_nombre_"></div>
                            </div>
                            <div class="input-area">
                                <label for="descripcion_" class="form-label">Descripcion de la zona</label>
                                <textarea name="descripcion_" id="descripcion_" class="form-control" cols="30" rows="2"></textarea>
                                <div id="_descripcion_"></div>
                            </div>

                            <div class="input-area">
                                <label for="fecha_creacion_" class="form-label">Ingrese nombre de la zona</label>
                                <input id="fecha_creacion_" name="fecha_creacion_" type="date" max="{{ date('Y-m-d') }}" class="form-control">
                                <div id="_fecha_creacion_"></div>
                            </div>

                            <div class="py-2">
                                <label for="tipo_zona_" class="form-label">Seleccione el tipo de Zona</label>
                                <select name="tipo_zona_" id="tipo_zona_" class="form-control w-full mt-2">
                                    <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">Seleccione un tipo de Zona</option>
                                    @foreach ($tipo_zona as $lis)
                                        <option value="{{ $lis->id }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ $lis->nombre }}</option>
                                    @endforeach
                                </select>
                                <div id="_tipo_zona_" ></div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button type="button" id="btn_guardar_zona_editado" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script_recaudaciones')
    <script>

        //para las fechas
        let fechaInput = document.getElementById('fecha_creacion');
        let fechaActual = new Date().toISOString().split('T')[0];
        let guardar_zona_btn = document.getElementById('btn_guardar_zona');
        fechaInput.setAttribute('max', fechaActual);
        fechaInput.addEventListener('change', ()=> {
            if (fechaInput.valueAsDate > new Date()) {
                alerta_top('error', 'No se pueden seleccionar fechas futuras.');
                fechaInput.value = '';
                guardar_zona_btn.disabled = true;
            }else{
                guardar_zona_btn.disabled = false;
            }
        });

        //para guardar los registros de la nueva zona
        guardar_zona_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_nuevo_zona')).entries());
            try {
                let respuesta = await fetch("{{ route('zn_crear') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_zona();
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
        //para vaciar los datos
        function vaciar_valores_modal_zona(){
            limpiar_campos('form_nuevo_zona');
            limpiar_campos('form_editar_zona');
            vaciar_errores_zona();
        }
        //para vacair los errores que pueda tener
        function vaciar_errores_zona(){
            let datos = ['_nombre','_descripcion', '_fecha_creacion', '_tipo_zona', '_nombre_','_descripcion_', '_fecha_creacion_', '_tipo_zona_'];
            datos.forEach(elem => {
                document.getElementById(elem).innerHTML='';
            });
        }
        //para eliminar la zona
        function eliminar_zona(id){
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
                    let respuesta = await fetch("{{ route('zn_eliminar') }}", {
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

        let fecha_sel = '';

        //para editar la zona
        async function editar_zona(id){
            try {
                let respuesta = await fetch("{{ route('zn_editar') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    $('#modal_editar_zona').modal('show');
                    document.getElementById('id_zona').value            = dato.mensaje.id;
                    document.getElementById('nombre_').value            = dato.mensaje.nombre;
                    document.getElementById('descripcion_').value       = dato.mensaje.descripcion;
                    document.getElementById('fecha_creacion_').value    = dato.mensaje.fecha_creacion;
                    document.getElementById('tipo_zona_').value         = dato.mensaje.id_tipo_zona;
                    fecha_sel = dato.mensaje.fecha_creacion;
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para cuadno se edita las fechas
        let fechaInput_e = document.getElementById('fecha_creacion_');
        let fechaActual_e = new Date().toISOString().split('T')[0];
        let guardar_zona_btn_edit = document.getElementById('btn_guardar_zona_editado');
        fechaInput_e.setAttribute('max', fechaActual_e);
        fechaInput_e.addEventListener('change', ()=> {
            if (fechaInput_e.valueAsDate > new Date()) {
                alerta_top('error', 'No se pueden seleccionar fechas futuras.');
                fechaInput_e.value = fecha_sel;
            }
        });

        //para guardar lo editado
        let guardar_zona_editado_btn = document.getElementById('btn_guardar_zona_editado');
        guardar_zona_editado_btn.addEventListener('click', async ()=>{
            let datos = Object.fromEntries(new FormData(document.getElementById('form_editar_zona')).entries());
            try {
                let respuesta = await fetch("{{ route('zn_editar_gr') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(datos)
                });
                let dato = await respuesta.json();
                vaciar_errores_zona();
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
