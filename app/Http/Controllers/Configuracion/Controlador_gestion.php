<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Servicio\Categoria_servicio;

class Controlador_gestion extends Controller{
    /**
     * @version 1.0
     * @author  Noemi Liz Solarez Chico <noemilizsolarez@gmail.com>
     * @param Controlador Administrar la parte de gestiones
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */

    public function gestion(){
        $data['menu'] = '4';
        $data['listar_gestion'] = Gestion::orderBy('id', 'desc')->get();
        return view('administrador.recaudaciones.configuracion.gestion', $data);
    }
    //para crear la gestion
    public function gestion_crear(Request $request){
        $validar = Validator::make($request->all(),[
            'gestion'  => 'required|unique:nl_gestion,gestion',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $gestion            = new Gestion;
            $gestion->gestion   =  $request->gestion;
            $gestion->estado    =  'activo';
            $gestion->save();
            if($gestion->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para editar ela gestion
    public function gestion_editar(Request $request){
        $gestion = Gestion::find($request->id);
        if($gestion->id){
            $data = mensaje_mostrar('success', $gestion);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para guardar lo editado
    public function gestion_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'gestion_'  => 'required|unique:nl_gestion,gestion,'.$request->id_gestion,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $gestion            = Gestion::find($request->id_gestion);
            $gestion->gestion   =  $request->gestion_;
            $gestion->save();
            if($gestion->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para eliminar la gestion
    public function gestion_eliminar(Request $request){
        try {
            $gestion = Gestion::find($request->id);
            if($gestion->delete()){
                $data = mensaje_mostrar('success', 'Se elimino  con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }

        return response()->json($data);
    }


    /**
     * PARA LA PARTE DE LA CATEGORIA
     */
    //para guardar lña categoria
    public function categoria_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_categoria'  => 'required',
            'precio_fijo'       => 'required'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $precio_fijo = sin_separador_comas($request->precio_fijo);
            if($request->id_categoria != NULL){
                $categoria              =  Categoria_servicio::find($request->id_categoria);
            }else{
                $categoria              =  new Categoria_servicio;
                $categoria->id_gestion  =  $request->id_ges;
            }
            $categoria->nombre      =  $request->nombre_categoria;
            $categoria->precio_fijo =  $precio_fijo;
            $categoria->save();
            if($categoria->id){
                $data = array(
                    'tipo'      =>  'success',
                    'mensaje'   =>  'Se guardo los datos con éxito',
                    'id_ges'   =>  $request->id_ges
                );
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para listar la categoria
    public function categoria_listar(Request $request){
        $categoria = Categoria_servicio::where('id_gestion',$request->id)->orderby('id', 'desc')->get();
        $data['categoria'] = $categoria;
        return view('administrador.recaudaciones.configuracion.listar_categoria', $data);
    }
    //para editar
    public function categoria_editar(Request $request){
        $categoria = Categoria_servicio::find($request->id);
        if($categoria->id){
            $data = array(
                'tipo'              => 'success',
                'nombre_cat'        => $categoria->nombre,
                'precio_fijo_cat'   => con_separador_comas($categoria->precio_fijo),
                'id_categoria'      => $categoria->id,
            );
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para eliminar
    public function categoria_eliminar(Request $request){
        try {
            $categoria = Categoria_servicio::find($request->id);
            if($categoria->delete()){
                $data = mensaje_mostrar('success', 'Se elimino con exitó');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }

        return response()->json($data);
    }
    /**
     * FIN DE SERVICIOS - CATEGORIA
     */
}
