<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Expedido;
use App\Models\Configuracion\Profesion;
use App\Models\Configuracion\Tipo_empresa;
use App\Models\Configuracion\Tipo_propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controlador_configuracion extends Controller
{
    /**
     * @version 1.0
     * @author  Colocar nombre del autor <coreo@gmail.com>
     * @param Controlador Administracion de la parte de la configuracion
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */


    /**
     * PARA LA PARTE DE CONFIGURACIÓN DE CATEGORIAS
     */
    public function categoria(){
        $data['menu'] = 4;
        return view('administrador.recaudaciones.configuracion.categoria', $data);
    }

    /**
     * FIN DE LA PARTE DE LAS CATEGORIAS
     */


    /**
     * PARTE DE LA PROFESIÓN
     */
    public function profesion(){
        $data['menu'] ='7';
        return view('administrador.recaudaciones.configuracion.profesion', $data);
    }

    //para listar la profesión
    public function profesion_listar(){
        $profesion = Profesion::orderBy('id', 'asc')->get();
        if($profesion){
            $data = mensaje_mostrar('success', $profesion);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar');
        }
        return response()->json($data);
    }
    //para guardar nueva profesion
    public function profesion_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'profesion'  => 'required|unique:nl_profesion,descripcion',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $profesion                  = new Profesion;
            $profesion->descripcion     =  $request->profesion;
            $profesion->save();
            if($profesion->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE PROFESIÓN
     */

    /**
     * PARTE DEL EXPEDIDO
    */
    public function expedido(){
        $data['menu'] ='8';
        return view('administrador.recaudaciones.configuracion.expedido', $data);
    }

    //para listar expedido
    public function expedido_listar(){
        $expedido = Expedido::orderBy('id', 'asc')->get();
        if($expedido){
            $data = mensaje_mostrar('success', $expedido);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar');
        }
        return response()->json($data);
    }

    //para guardar el expedido
    public function expedido_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'sigla'         => 'required|unique:nl_expedido,sigla',
            'descripcion'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $expedido               = new Expedido;
            $expedido->sigla        =  $request->sigla;
            $expedido->descripcion  =  $request->descripcion;
            $expedido->save();
            if($expedido->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
    * FIN DE LA PARTE EXPEDIDO
    */

    /**
     * PARTE DEL TIPO DE EMPRESA
    */
    public function tipo_empresa(){
        $data['menu'] ='9';
        return view('administrador.recaudaciones.configuracion.tipo_empresa', $data);
    }

    //para listar el
    public function tipo_empresa_listar(){
        $tipo_empresa = Tipo_empresa::orderBy('id', 'desc')->get();
        if($tipo_empresa){
            $data = mensaje_mostrar('success', $tipo_empresa);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar');
        }
        return response()->json($data);
    }

    //para guardar el tipo de empresa
    public function tipo_empresa_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'titulo'        => 'required|unique:nl_tipo_empresa,titulo',
            'descripcion'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo_empresa               =  new Tipo_empresa;
            $tipo_empresa->titulo       =  $request->titulo;
            $tipo_empresa->descripcion  =  $request->descripcion;
            $tipo_empresa->save();
            if($tipo_empresa->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
    * FIN DE LA PARTE TIPO DE EMPRESA
    */


    /**
     * PARA LA PARTE DE TIPO DE PROPIEDAD
     */
    public function tipo_propiedad(){
        $data['menu'] = 10;
        return view('administrador.recaudaciones.configuracion.tipo_propiedad',$data);
    }

    //para listar el tipo de propiedad
    public function tipo_propiedad_listar(){
        $listar_propiedad = Tipo_propiedad::get();
        if(!empty($listar_propiedad)){
            $data = mensaje_mostrar('success', $listar_propiedad);
        }else{
            $data = mensaje_mostrar('error', 'La lista esta vacia');
        }
        return response()->json($data);
    }
    //para crear un nuevo tipo de propiedad
    public function tipo_propiedad_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'titulo'        => 'required|unique:nl_tipo_propiedad,titulo',
            'descripcion'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo_empresa               =  new Tipo_propiedad;
            $tipo_empresa->titulo       =  $request->titulo;
            $tipo_empresa->descripcion  =  $request->descripcion;
            $tipo_empresa->save();
            if($tipo_empresa->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LAPARTE DE TIPO DE PROPIEDAD
     */
}
