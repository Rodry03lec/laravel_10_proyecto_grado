<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE PDF</title>
    <style>
        .my-table {
            border-collapse: collapse;
            width: 100%;
        }

        .my-table th,
        .my-table td {
            border: 1px solid black;
            padding: 10px;
        }

        .my-table th {
            background-color: #f2f2f2;
        }

        #thead tr {
            position: sticky;
            top: 0;
            background-color: #fff;
            /* Agrega un fondo blanco para evitar que se mezcle con el contenido */
        }

        .table-container {
            position: relative;
            page: auto;
        }

        .table-container:not(:first-child) {
            page-break-before: always;
        }

        .thead-container {
            position: absolute;
            top: 0;
            left: 0;
        }

        .corner-image {
            position: absolute;
            top: 10px;
            /* Ajusta la posición vertical */
            left: 10px;
            /* Ajusta la posición horizontal */
        }



        /*para */
        .img-esquina {
            position: absolute;
            width: 90px;
            margin-top: 10px;
        }

        .img-esquina-top-left {
            top: -20;
            left: 0;
            width: 100px;
        }

        .img-esquina-top-right {
            top: -20;
            right: -25px;
        }

        .formulario_esquina {
            position: absolute;
        }

        .form-esquina-top-rigth {
            top: -47;
            right: -25px;
        }

        .form-esquina-top-left {
            top: -60px;
            left: -30px;
        }

        .imagen-transparente {
            z-index: -1;
        }


        /**/
        .img_fondo {
            position: absolute;
            opacity: 0.8;
            top: 2%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            width: 70%;
        }

        .seccion {
            position: relative;
        }

        .text-primary {
            padding-top: 0px;
            margin-top: -18px;
        }

        .text-secundario {
            padding-top: 0px;
            margin-top: -12px;
        }

        .firmas {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .sello {
            text-align: center;
            margin-top: 20px;
        }

        p {
            text-align: justify;
            margin-bottom: 10px;
        }

        body {
            font-family: Arial;
            line-height: 1.2;
            margin: 20px;
        }

    </style>
</head>

<body >
    @php
        $img_logo = public_path('logos/logogamch.jpg');
        $imagen_logo = 'data:image/png;base64,' . base64_encode(file_get_contents($img_logo));

        $img_logo1 = public_path('logos/chulumani_logo.jpg');
        $imagen_logo1 = 'data:image/png;base64,' . base64_encode(file_get_contents($img_logo1));
    @endphp

    <div style="text-align: center; padding-top:5%">
        <h5 class="text-primary">GOBIERNO AUTÓNOMO MUNICIPAL DE CHULUMANI </h5>
        <h5 class="text-primary">"VILLA DE LA LIBERTAD"</h5>
        <h5 class="text-primary">CAPITAL DE LA PROVINCIA - SUD YUNGAS GESTIÓN {{ date('Y') }} </h5>
        <h4 class="text-primary">DEUDAS PENDIENTES GESTIÓN {{ $gestion->gestion }}</h4>
    </div>

    <img src="{{ $imagen_logo }}" class="img-esquina img-esquina-top-right imagen-transparente">
    <img src="{{ $imagen_logo1 }}" class="img-esquina img-esquina-top-left imagen-transparente">

    <h5 class="formulario_esquina form-esquina-top-left">Fecha de Impresión : {{ date('Y-m-d H:m:s') }}</h5>
    <h5 class="formulario_esquina form-esquina-top-rigth">GAMCH</h5>


    <hr>

    <table class="my-table" style="width: 100%; font-size:9px" >
        <thead>
            <tr>
                <th>Nº</th>
                <th>CI</th>
                <th>NOMBRES Y APELLIDOS</th>
                <th>TIPO</th>
                <th>CATEGORIA</th>
                <th>MESES PENDIENTES</th>
                <th>MONTO PENDIENTE</th>
                <th>MONTO LITERAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultados_instalados as $lis)
                @php
                    $anio_registrado    = date('Y', strtotime($lis['instalados']->registro_cobros->fecha));
                    $mes_registrado     = $lis['instalados']->registro_cobros->numero_mes;
                    $array_valores      = [];
                @endphp

                @foreach ($lis['resultado_meses'] as $resultado_mes)
                    @if ($resultado_mes['mes']->numero_mes >= $mes_registrado)
                        @if ($resultado_mes['factura_consulta']->isEmpty())
                            @php
                                $array_valores[] = $resultado_mes['mes']->nombre_mes;
                            @endphp
                        @endif
                    @endif
                @endforeach



                @if ($anio_registrado==$gestion->gestion)
                    @if (!empty($array_valores))
                        <tr>
                            <td class="table-td">{{ $loop->iteration }}</td>
                            @if ($lis['instalados']->id_persona_juridica != null && $lis['instalados']->id_persona_juridica != '' )
                                <td>
                                    @if ($lis['instalados']->persona_juridica->representante_legal->complemento != null && $lis['instalados']->persona_juridica->representante_legal->complemento != '')
                                        {{ $lis['instalados']->persona_juridica->representante_legal->ci.' '.$lis['instalados']->persona_juridica->representante_legal->complemento.' '.$lis['instalados']->persona_juridica->representante_legal->expedido->sigla }}
                                    @else
                                        {{ $lis['instalados']->persona_juridica->representante_legal->ci.' '.$lis['instalados']->persona_juridica->representante_legal->expedido->sigla }}
                                    @endif
                                </td>
                                <td>
                                    {{ $lis['instalados']->persona_juridica->representante_legal->nombres.' '.$lis['instalados']->persona_juridica->representante_legal->apellido_paterno.' '.$lis['instalados']->persona_juridica->representante_legal->apellido_materno }}
                                </td>
                                <td>
                                    JURIDICA
                                </td>
                            @else
                                <td>
                                    @if ($lis['instalados']->persona_natural->complemento != null && $lis['instalados']->persona_natural->complemento != '')
                                        {{ $lis['instalados']->persona_natural->ci.' '.$lis['instalados']->persona_natural->complemento.' '.$lis['instalados']->persona_natural->expedido->sigla }}
                                    @else
                                        {{ $lis['instalados']->persona_natural->ci.' '.$lis['instalados']->persona_natural->expedido->sigla }}
                                    @endif
                                </td>
                                <td>
                                    {{ $lis['instalados']->persona_natural->nombres.' '.$lis['instalados']->persona_natural->apellido_paterno.' '.$lis['instalados']->persona_natural->apellido_materno }}
                                </td>
                                <td>
                                    NATURAL
                                </td>
                            @endif

                            <td>
                                {{ $lis['instalados']->sub_categoria->nombre}}
                            </td>

                            <td>
                                @php
                                    $valores_nuevos = [];
                                    $conta = 0;
                                @endphp
                                @foreach ($lis['resultado_meses'] as $resultado_mes)
                                    @if ($resultado_mes['mes']->numero_mes >= $mes_registrado)
                                        @if ($resultado_mes['factura_consulta']->isEmpty())
                                            {{-- {{ $resultado_mes['mes']->nombre_mes }} --}}
                                            @php
                                                $valores_nuevos[] = $resultado_mes['mes']->nombre_mes;
                                                $conta = $conta + 1;
                                            @endphp
                                        @endif
                                    @endif
                                @endforeach
                                {{ implode(', ', $valores_nuevos) }}
                            </td>
                            <td>
                                {{ con_separador_comas($lis['instalados']->sub_categoria->precio_fijo * $conta).' Bs' }}
                            </td>
                            <td>
                                {{ convertir($lis['instalados']->sub_categoria->precio_fijo * $conta) }}
                            </td>
                        </tr>
                    @endif

                @else
                    @if (!empty($array_valores))
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if ($lis['instalados']->id_persona_juridica != null && $lis['instalados']->id_persona_juridica != '' )
                                <td>
                                    @if ($lis['instalados']->persona_juridica->representante_legal->complemento != null && $lis['instalados']->persona_juridica->representante_legal->complemento != '')
                                        {{ $lis['instalados']->persona_juridica->representante_legal->ci.' '.$lis['instalados']->persona_juridica->representante_legal->complemento.' '.$lis['instalados']->persona_juridica->representante_legal->expedido->sigla }}
                                    @else
                                        {{ $lis['instalados']->persona_juridica->representante_legal->ci.' '.$lis['instalados']->persona_juridica->representante_legal->expedido->sigla }}
                                    @endif
                                </td>
                                <td>
                                    {{ $lis['instalados']->persona_juridica->representante_legal->nombres.' '.$lis['instalados']->persona_juridica->representante_legal->apellido_paterno.' '.$lis['instalados']->persona_juridica->representante_legal->apellido_materno }}
                                </td>
                                <td>
                                    JURIDICA
                                </td>
                            @else
                                <td>
                                    @if ($lis['instalados']->persona_natural->complemento != null && $lis['instalados']->persona_natural->complemento != '')
                                        {{ $lis['instalados']->persona_natural->ci.' '.$lis['instalados']->persona_natural->complemento.' '.$lis['instalados']->persona_natural->expedido->sigla }}
                                    @else
                                        {{ $lis['instalados']->persona_natural->ci.' '.$lis['instalados']->persona_natural->expedido->sigla }}
                                    @endif
                                </td>
                                <td>
                                    {{ $lis['instalados']->persona_natural->nombres.' '.$lis['instalados']->persona_natural->apellido_paterno.' '.$lis['instalados']->persona_natural->apellido_materno }}
                                </td>
                                <td>
                                    NATURAL
                                </td>
                            @endif
                            <td>
                                {{ $lis['instalados']->sub_categoria->nombre }}
                            </td>
                            <td>
                                @php
                                    $valores_nuevos = [];
                                    $conta = 0;
                                @endphp

                                @foreach ($lis['resultado_meses'] as $resultado_mes)
                                    @if ($resultado_mes['factura_consulta']->isEmpty())
                                        @php
                                            $valores_nuevos[] = $resultado_mes['mes']->nombre_mes;
                                            $conta = $conta + 1;
                                        @endphp
                                    @endif
                                @endforeach
                                {{ implode(', ', $valores_nuevos) }}
                            </td>
                            <td>
                                {{ con_separador_comas($lis['instalados']->sub_categoria->precio_fijo * $conta).' Bs' }}
                            </td>
                            <td>
                                {{ convertir($lis['instalados']->sub_categoria->precio_fijo * $conta) }}
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
