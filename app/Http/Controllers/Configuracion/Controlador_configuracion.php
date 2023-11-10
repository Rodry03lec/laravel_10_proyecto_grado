<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Expedido;
use App\Models\Configuracion\Profesion;
use App\Models\Configuracion\Tipo_empresa;
use App\Models\Configuracion\Tipo_propiedad;
use App\Models\Servicio\Categoria_servicio;
use App\Models\Servicio\Sub_categoria;
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

    public function categoria_listar(){
        $listar_categoria = Categoria_servicio::get();
        if($listar_categoria){
            $data = mensaje_mostrar('success', $listar_categoria);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al listar');
        }
        return response()->json($data);
    }

    //para guardar nueva categoria
    public function categoria_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'categoria'  => 'required|unique:nl_categoria,nombre',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $categoria             = new Categoria_servicio;
            $categoria->nombre     =  $request->categoria;
            $categoria->save();
            if($categoria->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }

    //para eliminar la categoria
    public function categoria_eliminar(Request $request){
        try {
            $categoria = Categoria_servicio::find($request->id);
            if($categoria->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con exito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }

    //para editar la categoria
    public function categoria_editar(Request $request){
        $categoria = Categoria_servicio::find($request->id);
        if($categoria){
            $data = mensaje_mostrar('success', $categoria);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar los datos');
        }
        return response()->json($data);
    }
    //para guardar lo editado
    public function categoria_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'categoria_'  => 'required|unique:nl_categoria,nombre,'.$request->id_cat,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $categoria             = Categoria_servicio::find($request->id_cat);
            $categoria->nombre     =  $request->categoria_;
            $categoria->save();
            if($categoria->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para listar sub-categoria
    public function sub_categoria_listar(Request $request){
        $sub_categoria = Sub_categoria::where('id_categoria', $request->id)->orderby('id', 'desc')->get();
        $data['sub_categoria'] = $sub_categoria;
        return view('administrador.recaudaciones.configuracion.listar_sub_categoria', $data);
    }

    //para guardar el subcategoria
    public function sub_categoria_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_categoria'  => 'required',
            'precio_fijo'       => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{

            $precio_fijo = sin_separador_comas($request->precio_fijo);
            if($request->id_sub_categoria != NULL){
                $sub_categoria              =  Sub_categoria::find($request->id_sub_categoria);
            }else{
                $sub_categoria              =  new Sub_categoria;
                $sub_categoria->id_categoria  =  $request->id_categoria;
            }
            $sub_categoria->nombre          =  $request->nombre_categoria;
            $sub_categoria->precio_fijo     =  $precio_fijo;
            $sub_categoria->descripcion     =  $request->descripcion;
            $sub_categoria->save();
            if($sub_categoria->id){
                $data = array(
                    'tipo'      =>  'success',
                    'mensaje'   =>  'Se guardo los datos con éxito',
                    'id_cate'    =>  $request->id_categoria
                );
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }

    //para editar el subcategoria
    public function sub_categoria_editar(Request $request){
        $sub_categoria = Sub_categoria::find($request->id);
        if($sub_categoria->id){
            $data = array(
                'tipo'                  => 'success',
                'nombre_cat'            => $sub_categoria->nombre,
                'descripcion_cat'       => $sub_categoria->descripcion,
                'precio_fijo_cat'       => con_separador_comas($sub_categoria->precio_fijo),
                'id_sub_categoria_cat'  => $sub_categoria->id,
            );
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }

    //para eliminar sub categoria
    public function sub_categoria_eliminar(Request $request){
        try {
            $sub_categoria = Sub_categoria::find($request->id);
            if($sub_categoria->delete()){
                $data = mensaje_mostrar('success', 'Se elimino con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
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
    //para eliminar la profesion
    public function profesion_eliminar(Request $request){
        try {
            $profesion = Profesion::find($request->id);
            if($profesion->delete()){
                $data = mensaje_mostrar('success', 'Se elimino con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
        }
        return response()->json($data);
    }
    //para editar la profesion
    public function profesion_editar(Request $request){
        try {
            $profesion = Profesion::find($request->id);
            if($profesion){
                $data = mensaje_mostrar('success', $profesion);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //par aguardar la profesion editada
    public function profesion_edi_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'profesion_'  => 'required|unique:nl_profesion,descripcion,'. $request->id_profesion,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $profesion                  = Profesion::find($request->id_profesion);
            $profesion->descripcion     =  $request->profesion_;
            $profesion->save();
            if($profesion->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
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
    //para eliminar el expedido
    public function expedido_eliminar(Request $request){
        try {
            $profesion = Expedido::find($request->id);
            if($profesion->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con exitó');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    //para editar el expedido
    public function expedido_editar(Request $request){
        try {
            $profesion = Expedido::find($request->id);
            if($profesion){
                $data = mensaje_mostrar('success', $profesion);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al obtener los datos');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al obtener los datos');
        }
        return response()->json($data);
    }
    //para guardar lo editado
    public function expedido_edi_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'sigla_'         => 'required|unique:nl_expedido,sigla,'.$request->id_expedido,
            'descripcion_'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $expedido               = Expedido::find($request->id_expedido);
            $expedido->sigla        =  $request->sigla_;
            $expedido->descripcion  =  $request->descripcion_;
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
    //para eliminar el tipo de empresa
    public function tipo_empresa_eliminar(Request $request){
        try {
            $tipo_empresa = Tipo_empresa::find($request->id);
            if($tipo_empresa->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
        }
        return response()->json($data);
    }
    //para editar el tipo de empresa
    public function tipo_empresa_editar(Request $request){
        try {
            $tipo_empresa = Tipo_empresa::find($request->id);
            if($tipo_empresa){
                $data = mensaje_mostrar('success', $tipo_empresa);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al editar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al editar');
        }
        return response()->json($data);
    }

    //para guardar lo editado del tipo de empresa
    public function tipo_empresa_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'titulo_'        => 'required|unique:nl_tipo_empresa,titulo,'.$request->id_tipo_empresa,
            'descripcion_'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo_empresa               =  Tipo_empresa::find($request->id_tipo_empresa);
            $tipo_empresa->titulo       =  $request->titulo_;
            $tipo_empresa->descripcion  =  $request->descripcion_;
            $tipo_empresa->save();
            if($tipo_empresa->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
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
            $tipo_propiedad               =  new Tipo_propiedad;
            $tipo_propiedad->titulo       =  $request->titulo;
            $tipo_propiedad->descripcion  =  $request->descripcion;
            $tipo_propiedad->save();
            if($tipo_propiedad->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para eliminar el tipo de propiedads
    public function tipo_propiedad_eliminar(Request $request){
        try {
            $tipo_propiedad = Tipo_propiedad::find($request->id);
            if($tipo_propiedad->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
        }
        return response()->json($data);
    }
    //para editar el registro
    public function tipo_propiedad_editar(Request $request){
        try {
            $tipo_propiedad = Tipo_propiedad::find($request->id);
            if($tipo_propiedad){
                $data = mensaje_mostrar('success', $tipo_propiedad);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error ');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error ');
        }
        return response()->json($data);
    }
    //para guardar lo editados
    public function tipo_propiedad_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'titulo_'        => 'required|unique:nl_tipo_propiedad,titulo,'.$request->id_tipo_propiedad,
            'descripcion_'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $tipo_propiedad               =  Tipo_propiedad::find($request->id_tipo_propiedad);
            $tipo_propiedad->titulo       =  $request->titulo_;
            $tipo_propiedad->descripcion  =  $request->descripcion_;
            $tipo_propiedad->save();
            if($tipo_propiedad->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
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
