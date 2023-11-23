@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| INSTALADOS')
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
        <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">Listado de registros</li>
        </ul>
    </div>

    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                <div class="card-title text-slate-900 dark:text-white">Servicios</div>
                </div>
            </header>
            <div class="card-text h-full">
                <div>
                    <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                        <a href="#tabs-home-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent active dark:text-slate-300" id="tabs-home-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-home-withIcon" role="tab" aria-controls="tabs-home-withIcon" aria-selected="true">
                            <iconify-icon class="mr-1" icon="heroicons-outline:users"></iconify-icon>
                            Servicio Activo</a>
                        </li>
                        <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" id="tabs-profile-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile-withIcon" role="tab" aria-controls="tabs-profile-withIcon" aria-selected="false">
                            <iconify-icon class="mr-1" icon="heroicons-outline:users"></iconify-icon>
                            Servicio Inactivo</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="tabs-tabContent">
                        <div class="tab-pane fade show active" id="tabs-home-withIcon" role="tabpanel" aria-labelledby="tabs-home-withIcon-tab">
                            <div class="flex flex-wrap justify-between items-center mb-4">
                                <header class="card-header noborder">
                                    <h4 class="card-title">Listado de servicio activo</h4>
                                </header>
                                <div class="flex space-x-4 justify-end items-center rtl:space-x-reverse ">
                                    <a href="{{ route('pdf_instalados') }}" target="_blank" class="btn inline-flex justify-center btn-danger dark:bg-slate-800 m-1" >
                                        <span class="flex items-center">
                                            <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:file-doc"></iconify-icon>
                                            <span>Instados PDF</span>
                                        </span>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body px-6 pb-6">
                                <div class="overflow-x-auto -mx-2 dashcode-data-table">
                                    <span class=" col-span-8  hidden"></span>
                                    <span class="  col-span-4 hidden"></span>
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden ">
                                            <table id="tab_listar_servicio_activo" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                                style="width: 100%">
                                                <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                                    <tr>
                                                        <th scope="col" class="table-th">Nº</th>
                                                        <th scope="col" class="table-th">TIPO</th>
                                                        <th scope="col" class="table-th">CI</th>
                                                        <th scope="col" class="table-th">NOMBRES Y APELLIDOS</th>
                                                        <th scope="col" class="table-th">FECHA DE INSTALACIÓN</th>
                                                        <th scope="col" class="table-th">FECHA FIN INSTALACIÓN</th>
                                                        <th scope="col" class="table-th">ESTADO</th>
                                                        <th scope="col" class="table-th">ACCIONES</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabs-profile-withIcon" role="tabpanel" aria-labelledby="tabs-profile-withIcon-tab">
                            <div class="flex flex-wrap justify-between items-center mb-4">
                                <header class="card-header noborder">
                                    <h4 class="card-title">Listado de servicio inactivo</h4>
                                </header>
                            </div>

                            <div class="card-body px-6 pb-6">
                                <div class="overflow-x-auto -mx-2 dashcode-data-table">
                                    <span class=" col-span-8  hidden"></span>
                                    <span class="  col-span-4 hidden"></span>
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden ">
                                            <table id="tab_listar_sericio_inactivo" class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                                                style="width: 100%">
                                                <thead class=" bg-slate-200 dark:bg-slate-700 ">
                                                    <tr>
                                                        <th scope="col" class="table-th">Nº</th>
                                                        <th scope="col" class="table-th">TIPO</th>
                                                        <th scope="col" class="table-th">CI</th>
                                                        <th scope="col" class="table-th">NOMBRES Y APELLIDOS</th>
                                                        <th scope="col" class="table-th">FECHA DE INSTALACIÓN</th>
                                                        <th scope="col" class="table-th">FECHA FIN INSTALACIÓN</th>
                                                        <th scope="col" class="table-th">ESTADO</th>
                                                        <th scope="col" class="table-th">ACCIONES</th>
                                                    </tr>
                                                </thead>
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
    </div>
@endsection

@section('script_recaudaciones')
    <script>
        //para listar la parte de instalaciones activas
        async function listar_registro_activo(){
            let respuesta = await fetch("{{ route('its_activos') }}",{
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            });
            let dato = await respuesta.json();
            let i = 1;
            $('#tab_listar_servicio_activo').DataTable({
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
                            if(row.instalacion.id_persona_juridica !== null){
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
                            if(row.instalacion.id_persona_juridica !== null){
                                if(row.instalacion.persona_juridica.representante_legal.complemento !== null && row.instalacion.persona_juridica.representante_legal.complemento !== ''){
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_juridica.representante_legal.ci+` - `+row.instalacion.persona_juridica.representante_legal.complemento+` `+row.instalacion.persona_juridica.representante_legal.expedido.sigla+`</span>`;
                                }else{
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_juridica.representante_legal.ci+` `+row.instalacion.persona_juridica.representante_legal.expedido.sigla+`</span>`;
                                }

                            }else{

                                if(row.instalacion.persona_natural.complemento !== null && row.instalacion.persona_natural.complemento !== ''){
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_natural.ci+` - `+row.instalacion.persona_natural.complemento+` `+row.instalacion.persona_natural.expedido.sigla+`</span>`;
                                }else{
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_natural.ci+` `+row.instalacion.persona_natural.expedido.sigla+`</span>`;
                                }

                            }
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if(row.instalacion.id_persona_juridica !== null){
                                return row.instalacion.persona_juridica.representante_legal.nombres+' '+row.instalacion.persona_juridica.representante_legal.apellido_paterno+' '+row.instalacion.persona_juridica.representante_legal.apellido_materno;
                            }else{
                                return row.instalacion.persona_natural.nombres+' '+row.instalacion.persona_natural.apellido_paterno+' '+row.instalacion.persona_natural.apellido_materno;
                            }
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.instalacion.fecha_instalacion;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.instalacion.fecha_conclucion;
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if(row.estado =='activo'){
                                return `<span class="badge bg-success-500 text-white capitalize pill">activo</span>`;
                            }else{
                                return `<span class="badge bg-danger-500 text-white capitalize pill">inactivo</span>`;
                            }
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `
                                <div class="flex space-x-3 items-center ">


                                    <button class="action-btn btn-danger" onclick="ver_pdf_instalacion('${row.instalacion.id}')" type="button">
                                    <iconify-icon icon="heroicons:document-duplicate-solid"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-danger" onclick="ver_pdf_monto_instalacion('${row.instalacion.id}')" >
                                        <iconify-icon icon="ph:file-doc-duotone"></iconify-icon>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        }
        listar_registro_activo();
        //para registrar las instlaaciones inactivas
        async function listar_registro_inactivo(){
            let respuesta = await fetch("{{ route('its_inactivos') }}");
            let dato = await respuesta.json();
            let i = 1;
            $('#tab_listar_sericio_inactivo').DataTable({
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
                            if(row.instalacion.id_persona_juridica !== null){
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
                            if(row.instalacion.id_persona_juridica !== null){
                                if(row.instalacion.persona_juridica.representante_legal.complemento !== null && row.instalacion.persona_juridica.representante_legal.complemento !== ''){
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_juridica.representante_legal.ci+` - `+row.instalacion.persona_juridica.representante_legal.complemento+` `+row.instalacion.persona_juridica.representante_legal.expedido.sigla+`</span>`;
                                }else{
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_juridica.representante_legal.ci+` `+row.instalacion.persona_juridica.representante_legal.expedido.sigla+`</span>`;
                                }

                            }else{

                                if(row.instalacion.persona_natural.complemento !== null && row.instalacion.persona_natural.complemento !== ''){
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_natural.ci+` - `+row.instalacion.persona_natural.complemento+` `+row.instalacion.persona_natural.expedido.sigla+`</span>`;
                                }else{
                                    return `<span class="badge bg-slate-900 text-slate-900 dark:text-slate-200 bg-opacity-30 capitalize pill">`+row.instalacion.persona_natural.ci+` `+row.instalacion.persona_natural.expedido.sigla+`</span>`;
                                }

                            }
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if(row.instalacion.id_persona_juridica !== null){
                                return row.instalacion.persona_juridica.representante_legal.nombres+' '+row.instalacion.persona_juridica.representante_legal.apellido_paterno+' '+row.instalacion.persona_juridica.representante_legal.apellido_materno;
                            }else{
                                return row.instalacion.persona_natural.nombres+' '+row.instalacion.persona_natural.apellido_paterno+' '+row.instalacion.persona_natural.apellido_materno;
                            }
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.instalacion.fecha_instalacion;
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return row.instalacion.fecha_conclucion;
                        }
                    },

                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            if(row.estado =='activo'){
                                return `<span class="badge bg-success-500 text-white capitalize pill">activo</span>`;
                            }else{
                                return `<span class="badge bg-danger-500 text-white capitalize pill">inactivo</span>`;
                            }
                        }
                    },
                    {
                        data: null,
                        className: 'table-td',
                        render: function(data, type, row, meta) {
                            return `
                                <div class="flex space-x-3 items-center ">
                                    <button class="action-btn btn-warning" onclick="editar_servicio('${row.id}')" >
                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-primary" onclick="ver_servicio('${row.id}')" >
                                        <iconify-icon icon="heroicons:eye"></iconify-icon>
                                    </button>
                                    <button class="action-btn btn-danger" onclick="ver_pdf_instalacion('${row.id}')" type="button">
                                    <iconify-icon icon="heroicons:document-duplicate-solid"></iconify-icon>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        }
        listar_registro_inactivo();



        //para ver la instalacion realizada
        async function ver_pdf_instalacion(id){
            try {
                let respuesta = await fetch("{{ route('veins_instalado') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, 'Abriendo el PDF con exito');
                    setTimeout(() => {
                        window.open("{{ route('pdf_registro', ['id' => ':id']) }}".replace(':id', dato.mensaje), '_blank');
                    }, 1000);
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }

        //para ver la instalacion del servicion de agua por los 350.00  ... aqui es donde se deve verificar si funciona con los demas
        async function ver_pdf_monto_instalacion(id){
            try {
                let respuesta = await fetch("{{ route('veins_instalado') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({id:id})
                });
                let dato = await respuesta.json();
                if (dato.tipo === 'success') {
                    alerta_top(dato.tipo, 'Abriendo el PDF de instalación con exito');
                    setTimeout(() => {
                        window.open("{{ route('pdf_comprobante_instalacion', ['id' => ':id']) }}".replace(':id', dato.mensaje), '_blank');
                    }, 1000);
                }
                if (dato.tipo === 'error') {
                    alerta_top(dato.tipo, dato.mensaje);
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
            }
        }
    </script>
@endsection
