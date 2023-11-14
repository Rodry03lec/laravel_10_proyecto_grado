@if ($persona)
    <div class="grid xl:grid-cols-1 md:grid-cols-41 sm:grid-cols-1 grid-cols-1 gap-5 text-center py-5">
        <table class="table">
            <tr>
                <th>CI:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                @foreach ($persona as $lis)
                                    @if ($lis->complemento  != null && $lis->complemento != '')
                                        {{ $lis->ci.' - '.$lis->complemento.' '.$lis->expedido->sigla }}
                                    @else
                                    {{ $lis->ci.' '.$lis->expedido->sigla }}
                                    @endif

                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <th>NOMBRES Y APELLIDOS:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                @foreach ($persona as $lis)
                                    {{ $lis->nombres.' '.$lis->apellido_paterno.' '.$lis->apellido_materno }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
@endif


@if ($instalacion)
    <div class="grid xl:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 grid-cols-1 gap-5 text-center py-5">
        @foreach ($instalacion as $lis)
            <div class="card ring-1 ring-primary-500">
                <div class="card-body">
                    <div class="card-text h-full">
                        <header class="border-b px-4 pt-4 pb-3 flex items-center border-primary-500">
                        <iconify-icon class="text-3xl inline-block ltr:mr-2 rtl:ml-2 text-primary-500" icon="fluent:money-settings-16-filled"></iconify-icon>
                        @if ($lis->id_persona_juridica != null && $lis->id_persona_juridica != '')
                            <h3 class="card-title mb-0 text-primary-500">Jurídica</h3>
                        @else
                            <h3 class="card-title mb-0 text-primary-500">Natural</h3>
                        @endif

                        </header>
                        <div class="py-3 px-5">
                            @if ($lis->id_persona_juridica != null && $lis->id_persona_juridica != '')
                                <h5 class="card-subtitle"> Nombre de la empresa : {{ $lis->persona_juridica->nombre_empresa }}</h5>
                            @else
                                <h5 class="card-subtitle">Nombre persona : {{ $lis->persona_natural->nombres.' '.$lis->persona_natural->apellido_paterno.' '.$lis->persona_natural->apellido_materno }}</h5>
                            @endif
                        </div>
                        <div class="text-center py-2 px-5">
                            <a href="{{ route('cobr_lista', ['id'=>encriptar($lis->id)]) }}" class="btn inline-flex justify-center btn-dark">
                                <span class="flex items-center">
                                    <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:newspaper"></iconify-icon>
                                    <span>Ingresar</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
