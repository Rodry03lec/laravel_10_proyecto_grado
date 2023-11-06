<?php

namespace App\Http\Controllers\Personal_trabajo;

use App\Http\Controllers\Controller;
use App\Models\Persona\Natural;
use App\Models\Personal\Cargo;
use App\Models\Personal\Personal_trabajo;
use App\Models\Personal\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controlador_personal extends Controller
{
    /**
     * @version 1.0
     * @author  Colocar nombre del autor <coreo@gmail.com>
     * @param Controlador Administracion de la parte de la configuracion
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */

    /**
     * Administracion de la parte de unidad
     */
    public function unidad(){
        $data['menu'] = 13;
        return view('administrador.recaudaciones.personal_trabajo.unidad', $data);
    }
    //para listar las unidades
    public function unidad_listar(){
        $unidad = Unidad::orderBy('id','desc')->get();
        if($unidad){
            $data = mensaje_mostrar('success', $unidad);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar los datos');
        }
        return response()->json($data);
    }
    //para guardar la unidad
    public function unidad_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre'  => 'required|unique:nl_unidad,nombre',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $unidad                 = new Unidad;
            $unidad->nombre         =  $request->nombre;
            $unidad->descripcion    =  $request->descripcion;
            $unidad->save();
            if($unidad->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }

    //para eliminar la unidad
    public function unidad_eliminar(Request $request){
        try {
            $unidad = Unidad::find($request->id);
            if($unidad->delete()){
                $data = mensaje_mostrar('success', 'Se eliminó con exitó');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
        }
        return response()->json($data);
    }
    //para editar la unidad
    public function unidad_editar(Request $request){
        $unidad = Unidad::find($request->id);
        if($unidad){
            $data = mensaje_mostrar('success', $unidad);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un problema al editar');
        }
        return response()->json($data);
    }
    //para guardar lo editado de la unidad
    public function unidad_edi_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_'  => 'required|unique:nl_unidad,nombre,'.$request->id_unidad,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $unidad                 =  Unidad::find($request->id_unidad);
            $unidad->nombre         =  $request->nombre_;
            $unidad->descripcion    =  $request->descripcion_;
            $unidad->save();
            if($unidad->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
     * fin de la parte de administracion de la unidad
     */

    /**
      * PARA LA PARTE DE LOS CARGOS
      */
    public function cargo_listar(Request $request){
        $cargos = Cargo::where('id_unidad', $request->id)->orderBy('id', 'desc')->get();
        if(!empty($cargos)){
            $data = mensaje_mostrar('success', $cargos);
        }else{
            $data = mensaje_mostrar('error', 'no hay datos');
        }
        return response()->json($data);
    }

    //para guardar nuevo cargo
    public function cargo_nuevo(Request $request){
        if($request->id_cargo != null || $request->id_cargo != ''){
            $validar = Validator::make($request->all(),[
                'cargo'  => 'required|unique:nl_cargo,nombre,'.$request->id_cargo,
            ]);
        }else{
            $validar = Validator::make($request->all(),[
                'cargo'  => 'required|unique:nl_cargo,nombre',
            ]);
        }

        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            if($request->id_cargo != null || $request->id_cargo != ''){
                $cargo                 =  Cargo::find($request->id_cargo);
            }else{
                $cargo                 =  new Cargo();
                $cargo->id_unidad      = $request->id_uni;
            }
            $cargo->nombre         =  $request->cargo;
            $cargo->descripcion    =  $request->descripcion__;
            $cargo->save();
            if($cargo->id){
                $data = array(
                    'tipo' => 'success',
                    'mensaje' => 'Los datos se guardaron con éxito',
                    'id_unid' => $cargo->id_unidad
                );
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para editar el cargo
    public function cargo_editar(Request $request){
        $cargo = Cargo::find($request->id);
        if($cargo){
            $data = mensaje_mostrar('success', $cargo);
        }else{
            $data = mensaje_mostrar('error', 'ocurrio un error al mostrar los datos');
        }
        return response()->json($data);
    }
    //para eliminar el cargo
    public function cargo_eliminar(Request $request){
        try {
            $cargo = Cargo::find($request->id);
            if($cargo->delete()){
                $data = mensaje_mostrar('success', 'Se elimino con exito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE LOS CARGOS
     */



    /**
     * REGISTRO DEL PERSONAL
     */
    public function personal_trabajo(){
        $data['menu'] = 14;
        $data['listar_unidad'] = Unidad::orderBy('id','desc')->get();
        return view('administrador.recaudaciones.personal_trabajo.personal', $data);
    }
    //para listar el personal
    public function personal_listar($id){
        $data['menu'] = 14;
        $id_descript = desencriptar($id);
        $data['id_descript'] = $id_descript;
        $data['cargo'] = Cargo::where('id_unidad', $id_descript)->get();
        return view('administrador.recaudaciones.personal_trabajo.personal_registro', $data);
    }

    //para validar la persona
    public function personal_buscar(Request $request){
        $ci_persona = $request->ci;
        $persona = Natural::where('ci','like', $ci_persona)->get();
        if($persona->isNotEmpty()){
            //ahora si la persona esta activa o no, como funcionario o no
            $personal_alacaldia = Personal_trabajo::where('id_persona', $persona[0]->id)
                                                    ->where('estado', 'activo')
                                                    ->get();
            if($personal_alacaldia->isNotEmpty()){
                $data = mensaje_mostrar('error', 'La persona esta como funcionario, con un cargo');
            }else{
                $data = array(
                    'tipo'              =>  'success',
                    'mensaje'           =>  $persona,
                    'mensaje_mostrar'   =>  'Puede realizar el registro de la persona'
                );
            }
        }else{
            $data = mensaje_mostrar('error', 'La persona no se encuentra registrado en el sistema');
        }
        return response()->json($data);
    }
    /**
     * FIN DEL REGISTRO DEL PERSONAL
     */
}
