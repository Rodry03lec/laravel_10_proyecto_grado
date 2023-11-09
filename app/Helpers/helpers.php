<?php
    //para la parte de los mensajes
    function mensaje_mostrar($tipo, $mensaje){
        return array(
            'tipo'=>$tipo,
            'mensaje'=>$mensaje
        );
    }

    use Hashids\Hashids;
    //rodry
    function encriptar($id){
        $encriptado = new Hashids('eyJpdiI6Im42S3d0MzZwSlc2ZWZjOXlVTlZ4YXc9PSIsInZhbHVlIjoia1hmN08vNE9nUFRWcXR6a3E3YTNHZz09IiwibWFjIjoiZTEzOTVhY2NmNzljZTQ0OGQ0YzVkZmIxM2Q3MmJiYTU0NmUxZTVlZDEzNjhjNjBiZWY5MGE3MTRjZGNmZjUwYyIsInRhZyI6IiJ9', 15);
        $id1 = $encriptado->encodeHex($id);
        return $id1;
    }


    function desencriptar($id){
        $encriptado = new Hashids('eyJpdiI6Im42S3d0MzZwSlc2ZWZjOXlVTlZ4YXc9PSIsInZhbHVlIjoia1hmN08vNE9nUFRWcXR6a3E3YTNHZz09IiwibWFjIjoiZTEzOTVhY2NmNzljZTQ0OGQ0YzVkZmIxM2Q3MmJiYTU0NmUxZTVlZDEzNjhjNjBiZWY5MGE3MTRjZGNmZjUwYyIsInRhZyI6IiJ9', 15);
        $id1 = $encriptado->decodeHex($id);
        return $id1;
    }

    //para 1000000.00
    function sin_separador_comas($monto){
        $saldo_respuesta = str_replace(",", "", $monto);
        return $saldo_respuesta;
    }
    //para 100,000.00
    function con_separador_comas($monto){
        $saldo_respuesta = number_format($monto, 2, '.', ',');
        return $saldo_respuesta;
    }


    //para las fechas
    function fecha_literal($Fecha, $Formato) {
        $dias = array(
            0 => 'Domingo',
            1 => 'Lunes',
            2 => 'Martes',
            3 => 'Mièrcoles',
            4 => 'Jueves',
            5 => 'Viernes',
            6 => 'Sàbado'
        );
        $meses = array(
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre');
        $aux = date_parse($Fecha);
        switch ($Formato) {
            case 1:  // 04/10/23
                return date('d/m/y', strtotime($Fecha));
            case 2:  //04/oct/23
                return sprintf('%02d/%s/%02d', $aux['day'], substr($meses[$aux['month']], 0, 3), $aux['year'] % 100);
            case 3:   //octubre 4, 2023
                return $meses[$aux['month']] . ' ' . sprintf('%.2d', $aux['day']) . ', ' . $aux['year'];
            case 4:   // 4 de octubre de 2023
                return $aux['day'] . ' de ' . $meses[$aux['month']] . ' de ' . $aux['year'];
            case 5:   //lunes 4 de octubre de 2023
                $numeroDia= date('w', strtotime($Fecha));
                return $dias[$numeroDia].' '.$aux['day'] . ' de ' . $meses[$aux['month']] . ' de ' . $aux['year'];
            case 6:
                return date('d/m/Y', strtotime($Fecha));
            default:
                return date('d/m/Y', strtotime($Fecha));
        }
    }


    //para ver si es masculino femenino o prefiere no decir
    function verificar_persona_generto($genero){
        if($genero=='M'){
            return 'MASCULINO';
        }
        if($genero=='F'){
            return 'FEMENINO';
        }
        if($genero=='ND'){
            return 'PREFIERE NO DECIR';
        }
    }
