@extends('menu.principal_recaudaciones')
@section('titulo_recaudaciones', '| COBROS')
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
                Corbos
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="flex flex-wrap justify-between items-center mb-4">
            <header class="card-header noborder">
                <h4 class="card-title">Busqueda por CI</h4>
            </header>
        </div>
    </div>

    <div class="grid xl:grid-cols-1 md:grid-cols-1 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-body">
                <div class="card-text h-full">
                    <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500">
                    <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500" icon="fluent:add-circle-12-filled"></iconify-icon>
                    <h3 class="card-title mb-0 text-primary-500">Ingrese CI</h3>
                    </header>
                    <div class="py-3 px-5">
                        <form  method="post" autocomplete="off">
                            <div class="input-area">
                                <input id="ci" name="ci" type="text" class="form-control" placeholder="Ingrese ci de la persona Jurídica o Natural" onkeyup="buscar_ci_persona(this.value)" onkeypress="return soloNumeros(event)">
                            </div>
                        </form>
                    </div>
                    <div class="text-center py-4 px-5" id="listado_pagar_html">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde rerum illum laudantium dolores officia asperiores, voluptates adipisci cupiditate a vitae ex delectus similique tempora sequi minus voluptatibus quas nesciunt ut.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_recaudaciones')
    <script>
        async function buscar_ci_persona(ci){
            let listado_html = document.getElementById('listado_pagar_html');
            if(ci.length > 5){
                try {
                    let formData = new FormData();
                    formData.append('ci', ci);
                    formData.append('_token', token);
                    let respuesta = await fetch("{{ route('ci_busqueda') }}", {
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
            }else{
                listado_html.innerHTML = '';
            }
        }
    </script>
@endsection
