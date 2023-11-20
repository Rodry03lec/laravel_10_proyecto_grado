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
            top: 0;
            left: 0;
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
    @endphp

    <div style="text-align: center; padding-top:5%">
        <h5 class="text-primary">GOBIERNO AUTONOMO MUNICIPAL DE CHULUMANI </h5>
        <h5 class="text-primary">"VILLA DE LA LIBERTAD"</h5>
        <h5 class="text-primary">CAPITAL DE LA PROVINCIA - SUD YUNGAS GESTIÓN {{ date('Y') }} </h5>
        <h4 class="text-primary">REGISTRO DE INSTALACIÓN DE SERVICIOS DE AGUA</h4>
    </div>



    <img src="{{ $imagen_logo }}" class="img-esquina img-esquina-top-right imagen-transparente">

    <h5 class="formulario_esquina form-esquina-top-left">Fecha de Impresión : {{ date('Y-m-d H:m:s') }}</h5>
    <h5 class="formulario_esquina form-esquina-top-rigth">GAMCH</h5>


    <hr>

    <p>En la capital de Sud Yungas Chulumani, a los {{ date('d') }} días del mes de {{ obtenerNombreMes(date('m'))  }} de {{ date('Y') }}, comparecen:</p>

    <p>Por una parte de Gobierno Autonomo Municipal de Chulumani (GAMCH), a cargo de la : {{ $instalacion->personal_trabajo->cargo->unidad->nombre }}, representada con el cargo de {{ $instalacion->personal_trabajo->cargo->nombre }} por el {{ $instalacion->personal_trabajo->persona_natural->nombres.' '.$instalacion->personal_trabajo->persona_natural->apellido_paterno.' '.$instalacion->personal_trabajo->persona_natural->apellido_materno }}, con C.I. N° @if ($instalacion->personal_trabajo->persona_natural->complemento != null && $instalacion->personal_trabajo->persona_natural->complemento != '')
        {{ $instalacion->personal_trabajo->persona_natural->ci.' - '.$instalacion->personal_trabajo->persona_natural->complemento.' '.$instalacion->personal_trabajo->persona_natural->expedido->sigla }}
    @else
        {{ $instalacion->personal_trabajo->persona_natural->ci.' '.$instalacion->personal_trabajo->persona_natural->expedido->sigla }}
    @endif, en su calidad de responsable de la instalación de los servicios de agua en la vivienda ubicada en la zona {{ $instalacion->zona->nombre }}, dirección {{ $instalacion->direccion }}.</p>

    <p>Por otra parte, @if ($instalacion->id_persona_juridica != null && $instalacion->id_persona_juridica != '')
        {{ $instalacion->persona_juridica->representante_legal->nombres.' '.$instalacion->persona_juridica->representante_legal->apellido_paterno.' '.$instalacion->persona_juridica->representante_legal->apellido_materno }} ,con C.I. N° @if ($instalacion->persona_juridica->representante_legal->complemento != null && $instalacion->persona_juridica->representante_legal->complemento != '')
            {{ $instalacion->persona_juridica->representante_legal->ci.' - '.$instalacion->persona_juridica->representante_legal->complemento.' '.$instalacion->persona_juridica->representante_legal->expedido->sigla }}
        @else
            {{ $instalacion->persona_juridica->representante_legal->ci.' '.$instalacion->persona_juridica->representante_legal->expedido->sigla }}
        @endif, representante legal de la {{ $instalacion->persona_juridica->nombre_empresa }}
    @else
        {{ $instalacion->persona_natural->nombres.' '.$instalacion->persona_natural->apellido_paterno.' '.$instalacion->persona_natural->apellido_materno  }} con C.I. N° @if ($instalacion->persona_natural->complemento != null && $instalacion->persona_natural->complemento != '')
            {{ $instalacion->persona_natural->ci.' - '.$instalacion->persona_natural->complemento.' '.$instalacion->persona_natural->expedido->sigla }}
        @else
            {{ $instalacion->persona_natural->ci.' '.$instalacion->persona_natural->expedido->sigla }}
        @endif, en su calidad de {{ $instalacion->tipo_propiedad->titulo }} de la vivienda antes mencionada.
    @endif </p>

    <p>Datos de la instalación:</p>

    <table class="my-table" style="width: 100%; font-size:9px" >
        <thead>
            <tr>
                <th>FECHA INICIO DE INSTALACIÓN</th>
                <th>FECHA DE COCLUSIÓN</th>
                <th>MONTO DE INSTALACIÓN</th>
                <th>GLOSA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ fecha_literal($instalacion->fecha_instalacion, 3) }}</td>
                <td>{{ fecha_literal($instalacion->fecha_conclucion, 3) }}</td>
                <td>{{ con_separador_comas($instalacion->monto_instalacion).' Bs' }} <br> {{ convertir($instalacion->monto_instalacion) }} </td>
                <td>{{ $instalacion->glosa }}</td>
            </tr>
        </tbody>
    </table>

    <p>Ambas partes, de común acuerdo, hacen constar lo siguiente:</p>

    <ol>
        <li>El gobierno Autonomo Municipal de Chulumani especificamente la {{ $instalacion->personal_trabajo->cargo->unidad->nombre }} ha realizado la instalación de los servicios de agua potable y alcantarillado en la vivienda antes mencionada.</li>
        <li>La instalación ha sido realizada de acuerdo con las normas vigentes.</li>
        <li>La instalación cumple con las condiciones de seguridad y funcionamiento.</li>
    </ol>

    <div class="sello">
        <p>Además, este documento incluye una declaración de que la instalación cumple con las normas vigentes. Esta declaración es importante, ya que sirve como prueba de que la instalación es segura y cumple con los requisitos legales.</p>

        <p>Es importante mencionar que este documento es solo un ejemplo, y los documentos reales pueden variar en función de las condiciones locales. Por lo tanto, es recomendable consultar con un abogado para obtener más información sobre los requisitos legales para el registro de instalación de servicios de agua.</p>
    </div>

    <p>En prueba de lo anterior, firman las partes:</p>

    <div class="firmas">
        <div>
            <table class="my-table" style="width: 100%; font-size: 9px; border-collapse: collapse;">
                <tr>
                    <td style="padding-top: 40px; margin-bottom: 40px; margin: 0; border: 0; text-align: center;">-------------------------------------------------------<br>    CI : @if ($instalacion->personal_trabajo->persona_natural->complemento != null && $instalacion->personal_trabajo->persona_natural->complemento != '')
                            {{ $instalacion->personal_trabajo->persona_natural->ci.' - '.$instalacion->personal_trabajo->persona_natural->complemento.' '.$instalacion->personal_trabajo->persona_natural->expedido->sigla }}
                        @else
                            {{ $instalacion->personal_trabajo->persona_natural->ci.' '.$instalacion->personal_trabajo->persona_natural->expedido->sigla }}
                        @endif
                        <br>
                    NOMBRES Y APELLIDOS : {{ $instalacion->personal_trabajo->persona_natural->nombres.' '.$instalacion->personal_trabajo->persona_natural->apellido_paterno.' '.$instalacion->personal_trabajo->persona_natural->apellido_materno }}
                        <br>
                    CARGO : {{ $instalacion->personal_trabajo->cargo->nombre }}
                    <br>
                    UNIDAD : {{ $instalacion->personal_trabajo->cargo->unidad->nombre }}
                    </td>
                    <td style="padding-top: 40px; margin-bottom: 40px; margin: 0; border: 0; text-align: center;"> ------------------------------------------------------- <br>
                    @if ($instalacion->id_persona_juridica != null && $instalacion->id_persona_juridica != '')

                        CI : @if ($instalacion->persona_juridica->representante_legal->complemento != null && $instalacion->persona_juridica->representante_legal->complemento != '')
                        {{ $instalacion->persona_juridica->representante_legal->ci.' - '.$instalacion->persona_juridica->representante_legal->complemento.' '.$instalacion->persona_juridica->representante_legal->expedido->sigla }}
                        @else
                            {{ $instalacion->persona_juridica->representante_legal->ci.' '.$instalacion->persona_juridica->representante_legal->expedido->sigla }}
                        @endif
                        <br>
                        {{ $instalacion->persona_juridica->representante_legal->nombres.' '.$instalacion->persona_juridica->representante_legal->apellido_paterno.' '.$instalacion->persona_juridica->representante_legal->apellido_materno }}
                        <br>
                        {{ $instalacion->persona_juridica->nombre_empresa }}
                        <br>
                        TIPO : PERSONA JURÍDICA

                    @else
                        CI :  @if ($instalacion->persona_natural->complemento != null && $instalacion->persona_natural->complemento != '')
                            {{ $instalacion->persona_natural->ci.' - '.$instalacion->persona_natural->complemento.' '.$instalacion->persona_natural->expedido->sigla }}
                        @else
                            {{ $instalacion->persona_natural->ci.' '.$instalacion->persona_natural->expedido->sigla }}
                        @endif
                        <br>
                        NOMBRES Y APELLIDOS : {{ $instalacion->persona_natural->nombres.' '.$instalacion->persona_natural->apellido_paterno.' '.$instalacion->persona_natural->apellido_materno  }}
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


</body>

</html>

