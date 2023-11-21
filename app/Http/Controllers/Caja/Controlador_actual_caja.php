<?php

namespace App\Http\Controllers\Caja;

use App\Http\Controllers\Controller;
use App\Models\Caja\Caja_detalle;
use Illuminate\Http\Request;

class Controlador_actual_caja extends Controller{
    public function caja_actual_detalle(){
        $data['menu'] = 18;

        $caja_detalle_suma_entrada  = Caja_detalle::sum('monto_ingreso');
        $caja_detalle_suma_salida   = Caja_detalle::sum('monto_salida');
        $total_caja = $caja_detalle_suma_entrada - $caja_detalle_suma_salida;
        $data['total_caja'] = $total_caja;

        //ahora solo para la instalacion
        $monto_instalacion_entrada  = Caja_detalle::where('id_factura', null)->sum('monto_ingreso');
        $monto_instalacion_salida   = Caja_detalle::where('id_factura', null)->sum('monto_salida');
        $total_instalacion = $monto_instalacion_entrada - $monto_instalacion_salida;
        $data['total_caja_instalacion'] = $total_instalacion;

        //ahora por el cobro del servicio
        $monto_servicio_entrada  = Caja_detalle::where('id_factura','!=', null)->sum('monto_ingreso');
        $monto_servicio_salida   = Caja_detalle::where('id_factura','!=', null)->sum('monto_salida');
        $total_servicio = $monto_servicio_entrada - $monto_servicio_salida;
        $data['total_caja_servicio'] = $total_servicio;

        return view('administrador.recaudaciones.caja_actual.caja_actual',$data);
    }
}
