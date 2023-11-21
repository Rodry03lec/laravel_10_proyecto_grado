<html>

<head>
    <meta charset="utf-8">
    <title>Comprobante - Anual</title>
</head>
<style>
    * {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    html {
        font: 16px/1 'Open Sans', sans-serif;
        overflow: auto;
        padding: 0.5in;
    }

    html {
        background: #999;
        cursor: default;
    }

    body {
        box-sizing: border-box;
        height: 11in;
        margin: 0 auto;
        overflow: hidden;
        padding: 0.5in;
        width: 8.5in;
    }

    body {
        position: relative;
        background: #FFF;
        border-radius: 1px;
        box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
    }


    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 0.5em;
        text-align: center;
        text-transform: uppercase;
    }

    table {
        font-size: 75%;
        table-layout: fixed;
        width: 100%;
        border-collapse: separate;
        border-spacing: 2px;
    }

    table th {
        width: 40%;
        background: #f3f7fb;
        border-color: #84c9ff;
    }

    table td {
        width: 60%;
        border-color: #DDD;
    }

    table th,
    table td {
        border-width: 1px;
        padding: 0.5em;
        position: relative;
        text-align: left;
        border-radius: 0.25em;
        border-style: solid;
    }


    article:after {
        clear: both;
        content: "";
        display: table;
    }

    article h1 {
        clip: rect(0 0 0 0);
        position: absolute;
    }

    article P {
        float: left;
        font-size: 2em;
        font-weight: bold;
    }


    table.meta {
        float: right;
        width: 36%;
    }

    #legalcopy {
        margin-top: 30px;
    }

    .information {
        margin-top: 30px;
        font-size: .9em;
        color: #666;
        line-height: 1.2em;
        text-align: justify;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }

        html {
            background: none;
            padding: 0;
        }

        body {
            box-shadow: none;
            margin: 0;
        }

        span:empty {
            display: none;
        }

        .add,
        .cut {
            display: none;
        }
    }


    * {
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
    }

    html {
        font: 16px/1 'Open Sans', sans-serif;
        overflow: auto;
        padding: 0.5in;
    }

    html {
        background: #999;
        cursor: default;
    }

    body {
        box-sizing: border-box;
        height: 11in;
        margin: 0 auto;
        overflow: hidden;
        padding: 0.5in;
        width: 7in;
    }


    h1 {
        font: bold 100% sans-serif;
        letter-spacing: 2px;
        text-align: center;
        text-transform: uppercase;
    }

    table {
        font-size: 50%;
        table-layout: fixed;
        width: 100%;
        border-collapse: separate;
        border-spacing: 2px;
    }

    table th {
        width: 20%;
        background: #f3f7fb;
        border-color: #84c9ff;
    }

    table td {
        width: 80%;
        border-color: #DDD;
    }

    table th,
    table td {
        border-width: 1px;
        padding: 0.5em;
        position: relative;
        text-align: left;
        border-radius: 0.25em;
        border-style: solid;
    }


    article:after {
        clear: both;
        content: "";
        display: table;
    }

    article h1 {
        clip: rect(0 0 0 0);
        position: absolute;
    }

    article P {
        float: left;
        font-size: 2em;
        font-weight: bold;
    }


    table.meta {
        float: right;
        width: 60%;
    }

    #legalcopy {
        margin-top: 30px;
    }

    .information {
        margin-top: 10px;
        font-size: 12px;
        color: #666;
        line-height: 1.2em;
        text-align: justify;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact;
        }

        html {
            background: none;
            padding: 0;
        }

        body {
            box-shadow: none;
            margin: 0;
        }

        span:empty {
            display: none;
        }

        .add,
        .cut {
            display: none;
        }
    }

    @page {
        margin: 0;
    }

    @page {
        margin: 0;
    }
</style>

<body>

    @php
        $img_logo = public_path('logos/logogamch.jpg');
        $imagen_logo = 'data:image/png;base64,' . base64_encode(file_get_contents($img_logo));

        $img_logo_gradiante = public_path('imagenes/gradiante.jpg');
        $imagen_logo_gradiante = 'data:image/png;base64,' . base64_encode(file_get_contents($img_logo_gradiante));

        $img_logo_chulumani = public_path('logos/chulumani_logo.jpg');
        $imagen_logo_chulumani= 'data:image/png;base64,' . base64_encode(file_get_contents($img_logo_chulumani));
    @endphp

    <img src="{{ $imagen_logo_chulumani }}" style="width: 8%;" />
    <img src="{{ $imagen_logo }}" style="width: 8%; float: right;" />


    <img src="{{ $imagen_logo_gradiante }}" style="width: 100%; height: 4px" />


    <article style="margin: 1px">
        <h1>COMPROBANTE DE PAGO</h1>

        <table class="meta">
            <tr>
                <th colspan="2"
                    style="text-align: center; background: rgba(15, 157, 15, 0.23); color: rgba(15, 157, 15, 1); border-color: rgba(15, 157, 15, 1);">
                    DATOS
                </th>
            </tr>
            <tr>
                <th>Nombres</th>
                <td>
                    @if ($registro_cobros->instalacion->id_persona_juridica != null && $registro_cobros->instalacion->id_persona_juridica != '')
                        {{ $registro_cobros->instalacion->persona_juridica->representante_legal->nombres . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->apellido_paterno . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->apellido_materno }}
                        ,con C.I. N° @if (
                            $registro_cobros->instalacion->persona_juridica->representante_legal->complemento != null &&
                            $registro_cobros->instalacion->persona_juridica->representante_legal->complemento != '')
                            {{ $registro_cobros->instalacion->persona_juridica->representante_legal->ci . ' - ' . $instalacion->persona_juridica->representante_legal->complemento . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->expedido->sigla }}
                        @else
                            {{ $registro_cobros->instalacion->persona_juridica->representante_legal->ci . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->expedido->sigla }}
                        @endif, representante legal de la
                        {{ $registro_cobros->instalacion->persona_juridica->nombre_empresa }}
                        (Juridica)
                    @else
                        {{ $registro_cobros->instalacion->persona_natural->nombres . ' ' . $registro_cobros->instalacion->persona_natural->apellido_paterno . ' ' . $registro_cobros->instalacion->persona_natural->apellido_materno }}
                        con C.I. N° @if ($registro_cobros->instalacion->persona_natural->complemento != null && $registro_cobros->instalacion->persona_natural->complemento != '')
                            {{ $registro_cobros->instalacion->persona_natural->ci . ' - ' . $registro_cobros->instalacion->persona_natural->complemento . ' ' . $registro_cobros->instalacion->persona_natural->expedido->sigla }}
                        @else
                            {{ $registro_cobros->instalacion->persona_natural->ci . ' ' . $registro_cobros->instalacion->persona_natural->expedido->sigla }}
                        @endif
                        (Natural)
                    @endif
                </td>
            </tr>

            @if ($registro_cobros->instalacion->id_persona_juridica != null && $registro_cobros->instalacion->id_persona_juridica != '')
                <tr>
                    <th>Empresa</th>
                    <td>{{ $registro_cobros->instalacion->persona_juridica->nombre_empresa }}</td>
                </tr>
            @endif
            <tr>
                <th>Tipo / Categoria / Costo mensual</th>
                <td>
                    {{ $registro_cobros->instalacion->tipo_propiedad->titulo . ' / ' . $registro_cobros->instalacion->sub_categoria->categoria->nombre . ' "' . $registro_cobros->instalacion->sub_categoria->nombre . '" ' . con_separador_comas($registro_cobros->instalacion->sub_categoria->precio_fijo) . ' Bs' . ' (' . convertir($registro_cobros->instalacion->sub_categoria->precio_fijo) . ')' }}
                </td>
            </tr>
            <tr>
                <th>Ubicación</th>
                <td>{{ $registro_cobros->instalacion->zona->nombre . ', ' . $registro_cobros->instalacion->direccion }} </td>
            </tr>

            <tr>
                <th>Glosa</th>
                <td>{{ $registro_cobros->instalacion->glosa }}</td>
            </tr>

            <tr>
                <th>Gestión</th>
                <td>{{ $gestion->gestion }}</td>
            </tr>

            <tr>
                <th>Monto total Anual</th>
                <td>{{ con_separador_comas($monto_total_anual).' Bs ('.convertir($monto_total_anual).')' }}</td>
            </tr>
        </table>
    </article>

    <p class="information">
        La Alcaldía de la capital de Chulumani (Gobierno Autonomo Municipal de Chulumani 'GAMCH') está comprometida con
        proporcionar servicios de agua seguros y confiables para el bienestar de nuestra comunidad.
    </p>


    <p style="margin: 2px 0" align="center"> Detalle </p>
    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700"
                    style="width: 100%">
                    <thead class=" bg-slate-200 dark:bg-slate-700 ">
                        <tr>
                            <th scope="col" class="table-th">ID</th>
                            <th scope="col" class="table-th">MES</th>
                            <th scope="col" class="table-th">CODIGO</th>
                            <th scope="col" class="table-th">MONTO</th>
                            <th scope="col" class="table-th">FECHA PAGADO</th>
                            <th scope="col" class="table-th">ESTADO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $anio_registrado    = date('Y', strtotime($registro_cobros->fecha));
                            $mes_registrado     = $registro_cobros->numero_mes;
                            $monto_total        = 0;
                        @endphp



                        @foreach ($resultados as $resultado)
                            @if ($anio_registrado==$gestion->gestion)
                                @if ($resultado['mes']->numero_mes >= $mes_registrado)
                                    <tr>
                                        <td class="table-td">{{ $loop->iteration }}</td>
                                        <td class="table-td">{{ $resultado['mes']->nombre_mes }}</td>
                                        <@if (!$resultado['factura_consulta']->isEmpty())
                                            <td class="table-td">
                                                {{ $resultado['factura_consulta'][0]->numero_factura }}
                                            </td>
                                            <td class="table-td" style="width:180%">{{ con_separador_comas($registro_cobros->instalacion->sub_categoria->precio_fijo).' Bs ['.convertir($registro_cobros->instalacion->sub_categoria->precio_fijo).']' }}</td>
                                        @else
                                            <td class="table-td"></td>
                                            <td class="table-td"></td>
                                        @endif


                                        @if (!$resultado['factura_consulta']->isEmpty())
                                            <td class="table-td">
                                                {{ fecha_literal($resultado['factura_consulta'][0]->fecha,4) }}
                                            </td>
                                            <td class="table-td" style="color:rgb(0, 167, 42)9)" >
                                                <span>Pagado</span>
                                            </td>
                                            {{ $monto_total = $monto_total + $resultado['factura_consulta'][0]->caja_detalle->importe }}
                                        @else
                                            <td class="table-td">

                                            </td>
                                            <td class="table-td" style="color:rgb(167, 0, 0)9)">
                                                <span>Pendiente</span>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="table-td" style="width:10%">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ $resultado['mes']->nombre_mes }}</td>
                                    <@if (!$resultado['factura_consulta']->isEmpty())
                                        <td class="table-td">
                                            {{ $resultado['factura_consulta'][0]->numero_factura }}
                                        </td>
                                        <td class="table-td">{{ con_separador_comas($registro_cobros->instalacion->sub_categoria->precio_fijo).' Bs' }}</td>
                                    @else
                                        <td class="table-td"></td>
                                        <td class="table-td"></td>
                                    @endif

                                    @if (!$resultado['factura_consulta']->isEmpty())
                                        <td class="table-td" style="width:100%">
                                            {{ fecha_literal($resultado['factura_consulta'][0]->fecha,4) }}
                                        </td>
                                        <td class="table-td" style="color:rgb(0, 167, 42)9)" >
                                            <span>Pagado</span>
                                        </td>
                                        {{ $monto_total = $monto_total + $resultado['factura_consulta'][0]->caja_detalle->importe }}
                                    @else
                                        <td class="table-td">

                                        </td>
                                        <td class="table-td" style="color:rgb(167, 0, 0)9)">
                                            <span>Pendiente</span>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot style="background-color: rgba(0, 225, 255, 0.158)(0, 225, 255)">
                        <tr>
                            <td>Total cancelado</td>
                            <td colspan="2">{{ con_separador_comas($monto_total).' Bs ('.convertir($monto_total).')' }}</td>
                            <td>Monto faltante</td>
                            <td colspan="2">{{ con_separador_comas($monto_total_anual-$monto_total).' Bs ('.convertir($monto_total_anual-$monto_total).')' }}</td>
                        </tr>
                    </tfoot>
                </table>

    <div class="firmas">
        <div>
            <table class="my-table" style="width: 100%; font-size: 9px; border-collapse: collapse;">
                <tr>
                    <td style="padding-top: 40px; margin-bottom: 40px; margin: 0; border: 0; text-align: center;">
                        -------------------------------------------------------<br> CI :
                        {{ $usuario_registro->ci }}
                        <br>
                        USUARIO : {{ $usuario_registro->nombres.' '.$usuario_registro->apellido_paterno.' '.$usuario_registro->apellido_materno }}
                        <br>
                        CELULAR : {{ $usuario_registro->celular }}
                        <br>
                        Unidad
                    </td>
                    <td style="padding-top: 40px; margin-bottom: 40px; margin: 0; border: 0; text-align: center;">
                        ------------------------------------------------------- <br>
                        @if ($registro_cobros->instalacion->id_persona_juridica != null && $registro_cobros->instalacion->id_persona_juridica != '')

                            CI : @if (
                                $registro_cobros->instalacion->persona_juridica->representante_legal->complemento != null &&
                                $registro_cobros->instalacion->persona_juridica->representante_legal->complemento != '')
                                {{ $registro_cobros->instalacion->persona_juridica->representante_legal->ci . ' - ' . $registro_cobros->instalacion->persona_juridica->representante_legal->complemento . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->expedido->sigla }}
                            @else
                                {{ $registro_cobros->instalacion->persona_juridica->representante_legal->ci . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->expedido->sigla }}
                            @endif
                            <br>
                            {{ $registro_cobros->instalacion->persona_juridica->representante_legal->nombres . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->apellido_paterno . ' ' . $registro_cobros->instalacion->persona_juridica->representante_legal->apellido_materno }}
                            <br>
                            {{ $registro_cobros->instalacion->persona_juridica->nombre_empresa }}
                            <br>
                            TIPO : PERSONA JURÍDICA
                        @else
                            CI : @if ($registro_cobros->instalacion->persona_natural->complemento != null && $registro_cobros->instalacion->persona_natural->complemento != '')
                                {{ $registro_cobros->instalacion->persona_natural->ci . ' - ' . $registro_cobros->instalacion->persona_natural->complemento . ' ' . $registro_cobros->instalacion->persona_natural->expedido->sigla }}
                            @else
                                {{ $registro_cobros->instalacion->persona_natural->ci . ' ' . $registro_cobros->instalacion->persona_natural->expedido->sigla }}
                            @endif
                            <br>
                            NOMBRES Y APELLIDOS :
                            {{ $registro_cobros->instalacion->persona_natural->nombres . ' ' . $registro_cobros->instalacion->persona_natural->apellido_paterno . ' ' . $registro_cobros->instalacion->persona_natural->apellido_materno }}
                            <br>
                            TIPO : PERSONA NATURAL
                            <br>
                            <br>
                        @endif

                    </td>
                </tr>
            </table>

        </div>
    </div>
    <br>

</body>
</html>
