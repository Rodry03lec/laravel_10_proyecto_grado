<?php

namespace App\Http\Controllers\Servicio;

use App\Http\Controllers\Controller;
use App\Models\Caja\Caja_detalle;
use App\Models\Caja\Registro_cobros;
use App\Models\Configuracion\Tipo_propiedad;
use App\Models\Configuracion\Zonas;
use App\Models\Gestion;
use App\Models\Persona\Natural;
use App\Models\Personal\Cargo;
use App\Models\Personal\Unidad;
use App\Models\Servicio\Categoria_servicio;
use App\Models\Servicio\Historial_instalacion;
use App\Models\Servicio\Instalacion;
use App\Models\Servicio\Sub_categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DateTime;

class Controlador_instalacion extends Controller
{
    /**
     * para la parte de la instalacion de servicios
     */
    public function instalacion(){
        $data['menu'] = 15;
        $data['zonas'] = Zonas::get();
        $data['gestion'] = Gestion::orderBy('gestion','desc')->get();
        $data['categoria_listar'] = Categoria_servicio::orderBy('id','asc')->get();
        $data['propiedad'] = Tipo_propiedad::get();
        $data['unidad_responsable'] = Unidad::where('nombre','ilike','%intendencia%')->get();
        return view('administrador.recaudaciones.servicios.instalacion', $data);
    }

    //par ala parte de la busqueda de persona si existe o no b,
    public function instalacion_validar_persona(Request $request){
        $persona = Natural::with(['juridica_representante_legal'])->where('ci', 'like', $request->ci)->get();
        if(!$persona->isEmpty()){
            $data = mensaje_mostrar('success', $persona);
        }else{
            $data = mensaje_mostrar('error', 'Persona no registrada! ');
        }
        return response()->json($data);
    }

    //listar la instalacion
    public function instalacion_listar(){
        $instalacion = Instalacion::with(['zona', 'persona_natural','persona_juridica'=> function($query){
            $query->with(['representante_legal']);
        }, 'sub_categoria', 'tipo_propiedad'])->where('estado_instalacion','like', 'en_curso')->get();
        return response()->json($instalacion);
    }

    //para guardar nueva isntalacion
    public function instalacion_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'fecha_instalacion'      => 'required',
            'sub_categoria'          => 'required',
            'categoria'              => 'required',
            'monto_instalacion'      => 'required',
            'glosa'                  => 'required',
            'propiedad'              => 'required',
            'zona'                   => 'required',
            'direccion'              => 'required',
            'unidad_responsable'     => 'required',
            'cargo'                  => 'required',
            'funcionario'            => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $instalacion_nuevo = new Instalacion();

            $instalacion_nuevo->direccion               = $request->direccion;
            $instalacion_nuevo->fecha_instalacion       = $request->fecha_instalacion;
            $instalacion_nuevo->estado_instalacion      = 'en_curso';
            $instalacion_nuevo->monto_instalacion       = sin_separador_comas($request->monto_instalacion);
            $instalacion_nuevo->glosa                   = $request->glosa;
            $instalacion_nuevo->id_zona                 = $request->zona;
            $instalacion_nuevo->id_persona              = $request->persona_id;
            if($request->persona_natural_id != null || $request->persona_natural_id != ''){
                $instalacion_nuevo->id_persona_natural  = $request->persona_natural_id;
            }
            if($request->persona_juridica_id != null || $request->persona_juridica_id != ''){
                $instalacion_nuevo->id_persona_juridica = $request->persona_juridica_id;
            }
            $instalacion_nuevo->id_sub_categoria = $request->sub_categoria;
            $instalacion_nuevo->id_propiedad = $request->propiedad;

            $instalacion_nuevo->id_personal_trabajo = $request->funcionario;
            $instalacion_nuevo->id_usuario = Auth::id();
            $instalacion_nuevo->save();


            //ahora guardamos el historia de la instalacion
            $historial_instalacion                  = new Historial_instalacion();
            $historial_instalacion->fecha           = date('Y-m-d');
            $historial_instalacion->descripcion     = 'Primera instalación : '.$request->glosa;
            $historial_instalacion->id_usuario      = Auth::id();
            $historial_instalacion->id_instalacion  = $instalacion_nuevo->id;
            $historial_instalacion->save();

            //primero sumamos todos los importes
            //$sumar =

            //ahora tambien el monto de instalacion debe irse caja detalle
            $caja_detalle                   = new Caja_detalle();
            $caja_detalle->fecha            = date('Y-m-d');
            $caja_detalle->concepto         = 'Instalacion de agua';
            $caja_detalle->moneda           = 'Bolivianos';
            $caja_detalle->monto_ingreso    = sin_separador_comas($request->monto_instalacion);
            $caja_detalle->monto_salida     = 0;
            $caja_detalle->importe          = sin_separador_comas($request->monto_instalacion);
            $caja_detalle->estado           = 'entrada';
            $caja_detalle->id_usuario       = Auth::id();
            $caja_detalle->id_instalacion   = $instalacion_nuevo->id;
            $caja_detalle->id_factura       = null;
            $caja_detalle->save();

            if($instalacion_nuevo->id){
                $data =  array(
                    'tipo'      =>  'success',
                    'mensaje'   =>  'Se guardo los datos con éxito',
                    'instala_id' =>  encriptar($instalacion_nuevo->id)
                );
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
     * fin de la parte de instalacion de servicio
     */


    /**
     * para listar la categoria
     */
    public function listar_categoria(Request $request){
        $categoria = Categoria_servicio::where('id_gestion', $request->id)->get();
        if($categoria){
            $data = mensaje_mostrar('success', $categoria);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error');
        }
        return response()->json($data);
    }

    public function instalacion_categoria_listar(Request $request){
        $sub_categoria = Sub_categoria::find($request->id);
        if($sub_categoria){
            $data = mensaje_mostrar('success', $sub_categoria);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error');
        }
        return response()->json($data);
    }


    //para listar sub-categoria
    public function listar_sub_categoria(Request $request){
        $sub_categoria = Sub_categoria::where('id_categoria', $request->id)->get();
        if($sub_categoria){
            $data = mensaje_mostrar('success', $sub_categoria);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar la sub-categoria');
        }
        return response()->json($data);
    }

    //listar la unidad responsable y los responsables
    public function listar_cargo(Request $request){
        $cargo = Cargo::where('id_unidad', $request->id)->get();
        if($cargo){
            $data = mensaje_mostrar('success', $cargo);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un erro al mostrar los datos');
        }
        return response()->json($data);
    }

    //para listar los funcionariosn y que funcionario sera responsable
    public function listar_funcionario_res(Request $request){
        $personal_trabajo = Cargo::with(['personal_trabajo'=>function($q){
            $q->with('persona_natural');
            $q->where('estado', 'activo');
        }])->find($request->id);
        if($personal_trabajo){
            $data = mensaje_mostrar('success', $personal_trabajo);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un erro al mostrar los datos');
        }
        return response()->json($data);
    }

    //para finalizar la instalacion
    public function instalacion_finalizar(Request $request){
        $instalacion = Instalacion::find($request->id);
        if($instalacion){
            $data = mensaje_mostrar('success', $instalacion);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error');
        }
        return response()->json($data);
    }
    //para guardar la finalizacion de la instalacion
    public function finalizar_instalacion_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'fecha_finalizacion'    => 'required',
            'descripcion__'         => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $instalacion                        = Instalacion::find($request->instalacion_id);
            $instalacion->fecha_conclucion      = $request->fecha_finalizacion;
            $instalacion->estado_instalacion    = 'finalizado';
            $instalacion->save();

            //guardamos el historial de instalacion
            $historial_instalacion                  = new Historial_instalacion();
            $historial_instalacion->fecha           = date('Y-m-d');
            $historial_instalacion->descripcion     = $request->descripcion__;
            $historial_instalacion->id_usuario      = Auth::id();
            $historial_instalacion->id_instalacion  = $instalacion->id;
            $historial_instalacion->save();
            //ahora iniciamos o guardamos al registro cobros

            $fechaIni = new DateTime($request->fecha_finalizacion);
            $fechaIni->modify('+1 month');


            $registro_cobros                    = new Registro_cobros();
            $registro_cobros->numero_mes        = date('n', strtotime($fechaIni->format('Y-m-d')));
            $registro_cobros->fecha             = $fechaIni->format('Y-m-d');
            $registro_cobros->descripcion       = 'Resgitro de cobros';
            $registro_cobros->estado            = 'activo';
            $registro_cobros->id_instalacion    = $instalacion->id;
            $registro_cobros->save();

            if($registro_cobros->id){
                $data = array(
                    'tipo'      =>  'success',
                    'mensaje'   =>  'Se finalizo la instlacion y se guardo los datos con éxito',
                    'id_insta'  =>  encriptar($instalacion->id)
                );
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
}
