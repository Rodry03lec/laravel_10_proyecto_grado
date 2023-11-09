<?php

namespace App\Http\Controllers\Servicio;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Tipo_propiedad;
use App\Models\Configuracion\Zonas;
use App\Models\Gestion;
use App\Models\Persona\Natural;
use App\Models\Servicio\Categoria_servicio;
use App\Models\Servicio\Instalacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('administrador.recaudaciones.servicios.instalacion', $data);
    }

    //par ala parte de la busqueda de persona si existe o no
    public function instalacion_validar_persona(Request $request){
        $persona = Natural::with(['juridica_representante_legal'])->where('ci', 'like', $request->ci)->get();
        if(!$persona->isEmpty()){
            $data = mensaje_mostrar('success', $persona);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al mostrar');
        }
        return response()->json($data);
    }

    //listar la instalacion
    public function instalacion_listar(){
        $instalacion = Instalacion::with(['zona', 'persona_natural','persona_juridica'=> function($query){
            $query->with(['representante_legal']);
        }, 'categoria', 'tipo_propiedad'])->get();
        return response()->json($instalacion);
    }

    //para guardar nueva isntalacion
    public function instalacion_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'fecha_instalacion'      => 'required',
            'gestion'                => 'required',
            'categoria'              => 'required',
            'monto_instalacion'      => 'required',
            'glosa'                  => 'required',
            'propiedad'              => 'required',
            'zona'                   => 'required',
            'direccion'              => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $instalacion_nuevo = new Instalacion();

            $instalacion_nuevo->direccion = $request->direccion;
            $instalacion_nuevo->fecha_instalacion = $request->fecha_instalacion;
            $instalacion_nuevo->estado_instalacion = 'en_curso';
            $instalacion_nuevo->monto_instalacion = sin_separador_comas($request->monto_instalacion);
            $instalacion_nuevo->glosa = $request->glosa;
            $instalacion_nuevo->id_zona = $request->zona;
            if($request->persona_natural_id != null || $request->persona_natural_id != ''){
                $instalacion_nuevo->id_persona_natural = $request->persona_natural_id;
            }
            if($request->persona_juridica_id != null || $request->persona_juridica_id != ''){
                $instalacion_nuevo->id_persona_juridica = $request->persona_juridica_id;
            }
            $instalacion_nuevo->id_categoria = $request->categoria;
            $instalacion_nuevo->id_propiedad = $request->propiedad;



            $instalacion_nuevo->save();

            if($instalacion_nuevo->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
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
        $categoria = Categoria_servicio::find($request->id);
        if($categoria){
            $data = mensaje_mostrar('success', $categoria);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error');
        }
        return response()->json($data);
    }
}
