<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Tipo_zona;
use App\Models\Configuracion\Zonas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controlador_zona extends Controller{
    /**
     * @version 1.0
     * @author  Colocar nombre del autor <coreo@gmail.com>
     * @param Controlador Administracion de la parte de la gestión
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */

    /**
     * PARA LA PARTE DEL TIPO DE ZONA
    */
    public function tipo_zona(){
        $data['menu'] = '5';
        return view('administrador.recaudaciones.configuracion.tipo_zona', $data);
    }
    //para crear el tipo de zona
    public function tipo_zona_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre'  => 'required|unique:nl_tipo_zona,nombre',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo_zona            = new Tipo_zona;
            $tipo_zona->nombre   =  $request->nombre;
            $tipo_zona->save();
            if($tipo_zona->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para listar el tipo de zona
    public function tipo_zona_listar(Request $request){
        $tipo_zona = Tipo_zona::orderBy('id', 'desc')->get();
        if($tipo_zona){
            $data = mensaje_mostrar('success', $tipo_zona);
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al querer listar');
        }
        return response()->json($data);
    }

    //para eliminar el tipo de zona
    public function tipo_zona_eliminar(Request $request){
        try {
            $tipo_zona = Tipo_zona::find($request->id);
            if($tipo_zona->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error','Ocurrio un error al eliminar');
        }
        return response()->json($data, 200);
    }
    //para editar el tipo de zona
    public function tipo_zona_editar(Request $request){
        try {
            $tipo_zona = Tipo_zona::find($request->id);
            if($tipo_zona->id){
                $data = mensaje_mostrar('success', $tipo_zona);
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error','Ocurrio un error al editar');
        }
        return response()->json($data, 200);
    }
    //para guardar el tipo de zona editado
    public function tipo_zona_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_'  => 'required|unique:nl_tipo_zona,nombre,'.$request->id_tipo,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo_zona            = Tipo_zona::find($request->id_tipo);
            $tipo_zona->nombre   =  $request->nombre_;
            $tipo_zona->save();
            if($tipo_zona->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE TIPO E ZONA
     */

    /**
     * PARA LA PARTE DE LA ZONA
    *
    * @return void
    */
    public function zonas(){
        $data['menu'] = '6';
        $data['tipo_zona'] = Tipo_zona::get();
        $data['listar_zona'] = Zonas::with(['relacion_tipo_zona'])->get();
        return view('administrador.recaudaciones.configuracion.zona', $data);
    }
    //para guardar la zona
    public function zonas_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre'            => 'required|unique:nl_zonas,nombre',
            'descripcion'       => 'required',
            'fecha_creacion'    => 'required|date',
            'tipo_zona'         => 'required'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $zona                  = new Zonas;
            $zona->nombre          =  $request->nombre;
            $zona->descripcion     =  $request->descripcion;
            $zona->fecha_creacion  =  $request->fecha_creacion;
            $zona->id_tipo_zona    =  $request->tipo_zona;
            $zona->ultima_actualizacion    =  date('d-m-Y');
            $zona->save();
            if($zona->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para eliminar la zona
    public function zonas_eliminar(Request $request){
        try {
            $zona = Zonas::find($request->id);
            if($zona->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    //para editar la zona
    public function zonas_editar(Request $request){
        try {
            $zona = Zonas::find($request->id);
            if($zona->id){
                $data = mensaje_mostrar('success', $zona);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para guasrdar lo editado
    public function zonas_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_'            => 'required|unique:nl_zonas,nombre,'.$request->id_zona,
            'descripcion_'       => 'required',
            'fecha_creacion_'    => 'required|date',
            'tipo_zona_'         => 'required'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $zona                  = Zonas::find($request->id_zona);
            $zona->nombre          =  $request->nombre_;
            $zona->descripcion     =  $request->descripcion_;
            $zona->fecha_creacion  =  $request->fecha_creacion_;
            $zona->id_tipo_zona    =  $request->tipo_zona_;
            $zona->ultima_actualizacion    =  date('d-m-Y');
            $zona->save();
            if($zona->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE ZONA
     */
}
