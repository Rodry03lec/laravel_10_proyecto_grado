@extends('menu.principal_sistemas')
@section('titulo_sistemas', '| MODELO')
@section('contenido_sistemas')

    <div class="mb-5">
        <ul class="m-0 p-0 list-none">
            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                <a href="#">
                <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                </a>
            </li>
            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                Modelos
            </li>
        </ul>
    </div>


    <div class="grid xl:grid-cols-1 md:grid-cols-1 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-body">
                <div class="card-text h-full">
                    <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500">
                    <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500" icon="fluent:add-circle-12-filled"></iconify-icon>
                    <h3 class="card-title mb-0 text-primary-500">Seleccione un modelo</h3>
                    </header>
                    <div class="py-3 px-5">
                        <form  method="post" autocomplete="off">
                            <div class="input-area">
                                <select name="tipo_empresa" id="tipo_empresa" class="form-control w-full mt-2 py-2 text-lg" onchange="verificar_modelo(this.value)" >
                                    <option value="selected" selected="selected" disabled="disabled"  class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">[Seleccione el modelo]</option>
                                    @foreach ($modelos as $lis)
                                        <option value="{{ $lis}}"> {{ $lis }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="text-center py-4 px-5" id="listado_pagar_html">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts_sistemas')
    <script>
        async function verificar_modelo(valor){
            let listado_html = document.getElementById('listado_pagar_html');
            try {
                let formData = new FormData();
                formData.append('modelo', valor);
                formData.append('_token', token);
                let respuesta = await fetch("{{ route('mod_listar') }}", {
                    method: "POST",
                    body: formData
                });
                if (respuesta.ok) {
                    let data = await respuesta.text();
                    document.getElementById('listado_pagar_html').innerHTML = data;
                } else {
                    console.error("Error en la solicitud AJAX:", respuesta.status);
                    listado_html.innerHTML = '';
                }
            } catch (error) {
                console.log('Error de datos : ' + error);
                listado_html.innerHTML = '';
            }
        }
    </script>
@endsection
