<?php

namespace App\Http\Controllers\Personal_trabajo;

use App\Http\Controllers\Controller;
use App\Models\Persona\Natural;
use App\Models\Personal\Cargo;
use App\Models\Personal\Personal_trabajo;
use App\Models\Personal\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Controlador_personal extends Controller
{
    /**
     * @version 1.0
     * @author  Noemi Liz Solarez Chico <noemilizsolarez@gmail.com>
     * @param Controlador Administrar la parte de personal o funsionarios que estan trabajando en la alcaldia
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
                $data = mensaje_mostrar('error_funcionario', 'La persona esta como funcionario, con un cargo');
            }else{
                $data = array(
                    'tipo'              =>  'success',
                    'mensaje'           =>  $persona,
                    'mensaje_mostrar'   =>  'Puede realizar el registro de la persona'
                );
            }
        }else{
            $data = mensaje_mostrar('error_registro', 'La persona no se encuentra registrado en el sistema ');
        }
        return response()->json($data);
    }

    //para registrar el personas a una unidad
    public function personal_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'fecha_contratacion'    => 'required',
            'cargo'                 => 'required',
            'referencia_celular'    => 'required',
            'nombre_referencia'     => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $personal_trabajo                       =  new Personal_trabajo();
            $personal_trabajo->fecha_contratacion   =  $request->fecha_contratacion;
            $personal_trabajo->referencia_celular   =  $request->referencia_celular;
            $personal_trabajo->referencia_nombre    =  $request->nombre_referencia;
            $personal_trabajo->estado               =  'activo';
            $personal_trabajo->id_persona           =  $request->id_persona;
            $personal_trabajo->id_cargo             =  $request->cargo;
            $personal_trabajo->id_usuario           =  Auth::id();
            $personal_trabajo->save();
            if($personal_trabajo->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }

    //para listar persona activa
    public function personal_listar_activo(Request $request){
        $id_unidad = $request->id_unidad;
        $personal_trabajo = Personal_trabajo::with(['persona_natural'=>function($q1){
            $q1->with('expedido');
        },'cargo'=>function($query) use ($id_unidad){
            $query->where('id_unidad', $id_unidad);
        }])->where('estado', 'activo')->orderBy('id', 'asc')->get();
        return response()->json($personal_trabajo);
    }
    //para editar el personal
    public function personal_editar(Request $request){
        try {
            $personal_trabajo = Personal_trabajo::find($request->id);
            if($personal_trabajo){
                $data = mensaje_mostrar('success', $personal_trabajo);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al obtener los datos');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un error al obtener los datos');
        }
        return response()->json($data);
    }

    //para guardar lo editado
    public function personal_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'fecha_contratacion_'    => 'required',
            'cargo_'                 => 'required',
            'referencia_celular_'    => 'required',
            'nombre_referencia_'     => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $personal_trabajo                       =  Personal_trabajo::find($request->id_personal_tabajo);
            $personal_trabajo->fecha_contratacion   =  $request->fecha_contratacion;
            $personal_trabajo->referencia_celular   =  $request->referencia_celular;
            $personal_trabajo->referencia_nombre    =  $request->nombre_referencia;
            $personal_trabajo->id_usuario           =  Auth::id();
            $personal_trabajo->save();
            if($personal_trabajo->id){
                $data = mensaje_mostrar('success', 'Se edito los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar');
            }
        }
        return response()->json($data);
    }
    //para editar el estado para mandarlo como inactivo
    public function personal_estado(Request $request){
        $id_unidad = $request->id_unidad;
        $personal_trabajo = Personal_trabajo::with(['persona_natural'=>function($q1){
            $q1->with('expedido');
        },'cargo'=>function($query) use ($id_unidad){
            $query->where('id_unidad', $id_unidad);
        }])->find($request->id);
        if($personal_trabajo){
            $data = mensaje_mostrar('success', $personal_trabajo);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un problema');
        }
        return response()->json($data);
    }
    //para guardar el estado ya cambiando
    public function personal_estado_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'fecha_finalizacion'    => 'required',
            'descripcion__'         => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $personal_trabajo                       =  Personal_trabajo::find($request->id_personal_trabajo);
            $personal_trabajo->fecha_finalizacion   =  $request->fecha_finalizacion;
            $personal_trabajo->descripcion          =  $request->descripcion__;
            $personal_trabajo->estado               =  'inactivo';
            $personal_trabajo->id_usuario           =  Auth::id();
            $personal_trabajo->save();
            if($personal_trabajo->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar');
            }
        }
        return response()->json($data);
    }
    //para eliminar el registro
    public function personal_eliminar(Request $request){
        try {
            $personal_trabajo = Personal_trabajo::find($request->id);
            if($personal_trabajo->delete()){
                $data = mensaje_mostrar('success', 'Se elimino con éxito');
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio  un problema ale aliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio  un problema ale aliminar');
        }
        return response()->json($data);
    }

    //para listar las personas inactivas
    public function personal_listar_inactivo(Request $request){
        $id_unidad = $request->id_unidad;
        $personal_trabajo = Personal_trabajo::with(['persona_natural'=>function($q1){
            $q1->with('expedido');
        },'cargo'=>function($query) use ($id_unidad){
            $query->where('id_unidad', $id_unidad);
        }])->where('estado', '!=','activo')->orderBy('id', 'asc')->get();
        return response()->json($personal_trabajo);
    }
    /**
     * FIN DEL REGISTRO DEL PERSONAL
     */
}
