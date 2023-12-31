<fieldset>
    <legend>INFORMACIÓN PERSONAL</legend>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-7">
        <table class="table">
            <tr>
                <th>CI:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                @if ($persona_nat->complemento != null && $persona_nat->complemento != '')
                                    {{ $persona_nat->ci.' - '.$persona_nat->complemento.' '.$persona_nat->expedido->sigla }}
                                @else
                                    {{ $persona_nat->ci.' '.$persona_nat->expedido->sigla }}
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
                                {{ $persona_nat->nombres.' '.$persona_nat->apellido_paterno.' '.$persona_nat->apellido_materno }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>GENERO:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ verificar_persona_generto($persona_nat->genero) }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>ESTADO CIVIL:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_nat->estado_civil }}
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
                                @foreach ($persona_nat->profesion as $lis)
                                    <span class="badge bg-primary-500 text-primary-500 bg-opacity-30 capitalize pill">{{ $lis->descripcion }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>EMAIL:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_nat->email }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>ZONA:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_nat->zona->nombre.' :'. '['.$persona_nat->zona->descripcion.']' }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>DIRECCION DE DOMICILIO:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_nat->direccion }}
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
                                {{ $persona_nat->celular }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Nº CELULAR DE REFERENCIA:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_nat->celular_referencia }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>INFORMACIÓN ADICIONAL:</th>
                <td>
                    <div class="alert alert-outline-dark">
                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <div class="flex-1 font-Inter">
                                {{ $persona_nat->informacion_adicional }}
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</fieldset>
