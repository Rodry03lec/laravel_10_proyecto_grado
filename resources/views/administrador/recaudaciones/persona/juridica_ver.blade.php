<fieldset>
    <legend>REPRESENTANTE LEGAL</legend>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
        <table class="table">

            <tr>
                <th>CI:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                @if ($persona_ju->representante_legal->complemento != null && $persona_ju->representante_legal->complemento != '')
                                    {{ $persona_ju->representante_legal->ci.' - '.$persona_ju->representante_legal->complemento.' '.$persona_ju->expedido->sigla }}
                                @else
                                    {{ $persona_ju->representante_legal->ci.' '.$persona_ju->representante_legal->expedido->sigla }}
                                @endif
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>NOMBRES:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->representante_legal->nombres.' '.$persona_ju->representante_legal->apellido_paterno.' '.$persona_ju->representante_legal->apellido_materno }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>PROFESIONES:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                @foreach ($persona_ju->representante_legal->profesion as $lis)
                                    <span class="badge bg-primary-500 text-primary-500 bg-opacity-30 capitalize pill">{{ $lis->descripcion }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</fieldset>

<fieldset>
    <legend>INFORMACIÓN ADICIONAL</legend>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
        <table class="table">

            <tr>
                <th>TIPO DE EMPRESA:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->tipo_empresa->titulo.' : ['.$persona_ju->tipo_empresa->descripcion.']' }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>DESCRIPCIÓN DE ACTIVIDAD ECONOMICA :</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->actividad_economica }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>NUMERO DE TESTIMONIO :</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->numero_testimonio }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>NIT :</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->nit }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>NOMBRE DE LA EMPRESA:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->nombre_empresa }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Nº TELEFONO:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->telefono }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Nº CELULAR:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->celular }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>EMAIL DE LA EMPRESA:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->email }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>FECHA DE CONSTITUCIÓN :</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_ju->fecha_constitucion }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            @if ($persona_ju->testimonio!== null && $persona_ju->testimonio !== '')
                <tr>
                    <th>TESTIMONIO:</th>
                    <td>
                        <div class="alert alert-outline-dark">
                            <div class="flex items-start space-x-3 rtl:space-x-reverse">
                                <div class="flex-1 font-Inter">
                                    <div class="flex justify-center items-center py-2">
                                        <embed src="{{ asset('testimonio/'.$persona_ju->testimonio) }}" type="application/pdf" class="rounded-md border-4 border-slate-200 block" width="400" height="400">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                @endif
            </tr>
        </table>

    </div>
</fieldset>
