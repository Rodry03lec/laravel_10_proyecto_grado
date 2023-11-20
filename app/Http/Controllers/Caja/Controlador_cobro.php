<?php

namespace App\Http\Controllers\Caja;

use App\Http\Controllers\Controller;
use App\Models\Caja\Caja_detalle;
use App\Models\Caja\Facturacion;
use App\Models\Caja\Registro_cobros;
use App\Models\Gestion;
use App\Models\Mes;
use App\Models\Persona\Juridica;
use App\Models\Persona\Natural;
use App\Models\Servicio\Instalacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class Controlador_cobro extends Controller
{
    //
    public function cobros_busqueda(){
        $data['menu'] = 17;
        return view('administrador.caja.cobros', $data);
    }

    //para buscar po ci
    public function busqueda_ci(Request $request){
        $ci = $request->ci;
        $persona_natural = Natural::with(['expedido'])->where('ci', 'like', $ci)->get();
        if($persona_natural->count() > 0){
            $instalacion = Instalacion::with(['persona_natural','persona_juridica','registro_cobros'=>function($q){
                $q->where('estado','activo');
            }])->where('id_persona', $persona_natural[0]->id)
            ->where('estado_instalacion', 'finalizado')
            ->get();
        }else{
            $instalacion = null;
            $persona_natural = null;
        }

        $data['instalacion'] = $instalacion;
        $data['persona'] = $persona_natural;
        return view('administrador.caja.busqueda_vista', $data);
    }

    //para realizar los cobros corespondientes
    public function cobros($id){
        $id_descript = desencriptar($id);
        $instalacion = Instalacion::with(['sub_categoria','registro_cobros'=>function($q1){
            $q1->with(['facturacion'=>function($q2){
                $q2->with(['gestion','mes','caja_detalle']);
            }]);
        },'persona_natural','persona_juridica'])->find($id_descript);

        $persona = Natural::with(['expedido'])->find($instalacion->id_persona);
        $data['instalacion'] = $instalacion;
        $data['menu'] = 17;
        $data['gestion'] = Gestion::where('estado','activo')->get();
        $data['mes'] = Mes::get();
        $data['mes_unico'] = Mes::find($instalacion->registro_cobros->numero_mes);
        $data['persona'] = $persona;
        return view('administrador.caja.cobros_especificos', $data);
    }

    //para listar la gestion
    public function listar_gestion(){
        $gestion = Gestion::where('estado','activo')->get();
        if($gestion){
            $data = mensaje_mostrar('success', $gestion);
        }else{
            $data = mensaje_mostrar('success', 'Ocurrio un error al mostrar');
        }
        return response()->json($data);
    }

    public function cobro_gestion(Request $request){
        $id_gestion = $request->id_gestion;
        $id_registro_cobro = $request->id_registro_cobro;

        $gestion = Gestion::find($id_gestion);

        $registro_cobro = Registro_cobros::with(['facturacion'=>function($q){
            $q->with(['gestion','mes']);
        }])->find($id_registro_cobro);

        $data['gestion_lis']    = $gestion;
        $data['mes_lis']        = Mes::get();
        $data['registro_cobro'] = $registro_cobro;

        $facturacion = Facturacion::where('id_gestion', $gestion->id)->get();
        $data['facturacion'] = $facturacion;
        return view('administrador.caja.cobro_mes', $data);
    }

    //para el cobro anual
    public function cobro_anual(Request $request){
        $id_gestion =  $request->id_gestion;
        $id_registro_cobro =  $request->id_registro_cobro;

        $facturacion = Facturacion::with(['mes', 'caja_detalle'])
                                ->where('id_registro_cobro',$id_registro_cobro)
                                ->where('id_gestion', $id_gestion)
                                ->orderBy('id', 'asc')
                                ->get();
        $gestion = Gestion::find($id_gestion);
        if ($facturacion->isEmpty()) {
            $registro_cobro = Registro_cobros::with(['instalacion'=>function($i){
                $i->with(['sub_categoria'=>function($sc){
                    $sc->with(['categoria']);
                }]);
            },'facturacion'=>function($q){
                $q->with(['gestion','mes']);
            }])->find($id_registro_cobro);

            //para saver el monto verificamos
            $monto_pago_mensual = $registro_cobro->instalacion->sub_categoria->precio_fijo;
            $monto_sumado_anual = $monto_pago_mensual * 12;

            //ahora verificamos de que gestion y mes esta empezando
            $anio_registrado    = date('Y', strtotime($registro_cobro->fecha));
            $mes_registrado     = $registro_cobro->numero_mes;

            if($gestion->gestion == $anio_registrado){
                if($mes_registrado == 1 ){
                    $data['pagar_no'] = 1;
                    $data['mensaje'] = 'Se puede pagar anual';
                }else{
                    $data['pagar_no'] = 0;
                    $data['mensaje'] = 'No se puede pagar anual';
                }
            }else if($gestion->gestion > $anio_registrado){
                $data['pagar_no'] = 1;
                $data['mensaje'] = 'Puede pagar anualmente';
            }else{
                $data['pagar_no'] = 0;
                $data['mensaje'] = 'Ocurrio un problema de gestiones';
            }


            $data['gestion_anual']          = $gestion;
            $data['registro_cobro_anual']   = $registro_cobro;
            $data['id_instalacion_cobros']   = $registro_cobro->instalacion->id;
            $data['monto_pagar_mensual']   = con_separador_comas($monto_pago_mensual);
            $data['monto_pagar_anual']   = con_separador_comas($monto_sumado_anual);
            $data['existe_no'] = 1;
            $data['id_registro_cobros'] = $id_registro_cobro;
            $data['id_gestion_cobros'] = $id_gestion;
            $data['listar_facturacion'] = null;
        } else {
            //esto areglar
            if(count($facturacion)==12){
                $data['mensaje'] = 'NOTA: SE CANCELO DE TODOS LOS MESES';
            }else{
                $data['mensaje'] = 'Tiene al menos uno o mas pagados mensualmente, Porfavor continue cancelando mensualmente';
            }
            $data['existe_no'] = 0;
            $data['pagar_no'] = 0;
            $data['listar_facturacion'] = $facturacion;
            $data['gestion_anual']          = $gestion;
        }

        return view('administrador.caja.cobros.cobro_anual', $data);
    }

    //para pagar anual completo todo
    public function cobro_anual_guardar(Request $request){
        $mes = Mes::get();
        foreach($mes as $lis){
            $facturacion                    = new Facturacion();
            $facturacion->numero_factura    = date('YmdHis');
            $facturacion->id_gestion        = $request->id_gestion_cobros;
            $facturacion->id_mes            = $lis->id;
            $facturacion->fecha             = date('Y-m-d');
            $facturacion->id_registro_cobro = $request->id_registro_cobros;
            $facturacion->estado            = 'pagado';
            $facturacion->save();

            //para guardar en nl_caja_detalle
            $caja_detalle_nuevo = new Caja_detalle();
            $caja_detalle_nuevo->fecha = date('Y-m-d');
            $caja_detalle_nuevo->concepto = 'Pago realizado del mes de : '.$lis->nombre_mes;
            $caja_detalle_nuevo->moneda = 'Bs';
            $caja_detalle_nuevo->monto_ingreso = sin_separador_comas($request->monto_mensual_cobros);
            $caja_detalle_nuevo->monto_salida = 0;
            $caja_detalle_nuevo->importe = sin_separador_comas($request->monto_mensual_cobros);
            $caja_detalle_nuevo->estado = 'entrada';
            $caja_detalle_nuevo->id_usuario = Auth::id();
            $caja_detalle_nuevo->id_instalacion = $request->id_instalacion_cobros;
            $caja_detalle_nuevo->id_factura = $facturacion->id;
            $caja_detalle_nuevo->save();
        }

        $data = mensaje_mostrar('success','Se realizo el pago anual con exito');
        return response()->json($data);
    }


    //para el cobro mensual
    public function cobro_mensual(Request $request){
        $id_gestion         = $request->id_gestion;
        $id_registro_cobro  = $request->id_registro_cobro;

        $facturacion        = Facturacion::with(['mes', 'caja_detalle'])
                                ->where('id_registro_cobro',$id_registro_cobro)
                                ->where('id_gestion', $id_gestion)
                                ->orderBy('id', 'asc')
                                ->get();
        $registro_cobros    = Registro_cobros::with(['facturacion','instalacion'=>function($i){
            $i->with(['sub_categoria']);
        },'facturacion'=>function($q){
            $q->with(['gestion','mes']);
        }])->find($id_registro_cobro);
        $gestion            = Gestion::find($id_gestion);
        $mes                = Mes::orderBy('numero_mes', 'asc')->get();

        $data['facturacion']        = $facturacion;
        $data['registro_cobros']    = $registro_cobros;

        $data['gestion']            = $gestion;
        $data['mes']                = $mes;
        $data['id_registro_c']      = $id_registro_cobro;


        $resultados = [];

        foreach ($mes as $m) {
            // Realizar la consulta según tus condiciones
            $factura_consulta = Facturacion::where('id_gestion', $gestion->id)
                ->where('id_mes', $m->id)
                ->where('id_registro_cobro', $registro_cobros->id)
                ->get();

            // Agregar el resultado al array
            $resultados[] = [
                'mes' => $m,
                'factura_consulta' => $factura_consulta,
            ];
        }
        $data['resultados'] = $resultados;


        return view('administrador.caja.cobros.cobro_mes', $data);
    }

    //para guardar el cobro del mes
    public function cobro_mensual_guardar(Request $request){

        //primero verificamos el monto que debe cancelar con el id_registro_conbro

        $registro_cobro = Registro_cobros::with(['instalacion'=>function($i){
            $i->with(['sub_categoria']);
        }])->find($request->id_registro_cobro);

        $facturacion                    = new Facturacion();
        $facturacion->numero_factura    = date('YmdHis');
        $facturacion->id_gestion        = $request->id_gestion;
        $facturacion->id_mes            = $request->id_mes;
        $facturacion->fecha             = date('Y-m-d');
        $facturacion->id_registro_cobro = $request->id_registro_cobro;
        $facturacion->estado            = 'pagado';
        $facturacion->save();

        //para guardar en nl_caja_detalle
        $caja_detalle_nuevo                 = new Caja_detalle();
        $caja_detalle_nuevo->fecha          = date('Y-m-d');
        $caja_detalle_nuevo->concepto       = 'Pago realizado del mes de : '.$request->nombre_mes;
        $caja_detalle_nuevo->moneda         = 'Bs';
        $caja_detalle_nuevo->monto_ingreso  = sin_separador_comas($registro_cobro->instalacion->sub_categoria->precio_fijo);
        $caja_detalle_nuevo->monto_salida   = 0;
        $caja_detalle_nuevo->importe        = sin_separador_comas($registro_cobro->instalacion->sub_categoria->precio_fijo);
        $caja_detalle_nuevo->estado         = 'entrada';
        $caja_detalle_nuevo->id_usuario     = Auth::id();
        $caja_detalle_nuevo->id_instalacion = $registro_cobro->instalacion->id;
        $caja_detalle_nuevo->id_factura     = $facturacion->id;
        $caja_detalle_nuevo->save();

        if($caja_detalle_nuevo->id){
            $data = mensaje_mostrar('success', 'Se pago el mes de : '. $request->nombre_mes .' con exito');
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un problema al cobrar ...');
        }
        return response()->json($data);
    }

    //para guardar todo conjunto seleccionados
    public function cobro_mensual_guardar_conjunto(Request $request){
        $id_gestion = $request->formulario['id_gestion_mes'];
        $id_registro_cobro = $request->formulario['id_registro_cobros_mes'];

        $registro_cobro = Registro_cobros::with(['instalacion'=>function($i){
            $i->with(['sub_categoria']);
        }])->find($id_registro_cobro);

        foreach ($request->idsSeleccionados as $lis) {
            //para mostrar el nombre del mes que se va pagar
            $mes = Mes::find($lis);
            //ahora guardamos lo de la facturación
            $facturacion                    = new Facturacion();
            $facturacion->numero_factura    = date('YmdHis');
            $facturacion->id_gestion        = $id_gestion;
            $facturacion->id_mes            = $lis;
            $facturacion->fecha             = date('Y-m-d');
            $facturacion->id_registro_cobro = $id_registro_cobro;
            $facturacion->estado            = 'pagado';
            $facturacion->save();

            //para guardar en nl_caja_detalle
            $caja_detalle_nuevo                 = new Caja_detalle();
            $caja_detalle_nuevo->fecha          = date('Y-m-d');
            $caja_detalle_nuevo->concepto       = 'Pago realizado del mes de : '.$mes->nombre_mes;
            $caja_detalle_nuevo->moneda         = 'Bs';
            $caja_detalle_nuevo->monto_ingreso  = sin_separador_comas($registro_cobro->instalacion->sub_categoria->precio_fijo);
            $caja_detalle_nuevo->monto_salida   = 0;
            $caja_detalle_nuevo->importe        = sin_separador_comas($registro_cobro->instalacion->sub_categoria->precio_fijo);
            $caja_detalle_nuevo->estado         = 'entrada';
            $caja_detalle_nuevo->id_usuario     = Auth::id();
            $caja_detalle_nuevo->id_instalacion = $registro_cobro->instalacion->id;
            $caja_detalle_nuevo->id_factura     = $facturacion->id;
            $caja_detalle_nuevo->save();

            if($caja_detalle_nuevo->id){
                $data = mensaje_mostrar('success', 'Se guardo con exito los meses');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error en el guardado');
            }
        }

        return response()->json($data);
    }
}
