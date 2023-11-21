<?php

namespace App\Http\Controllers\Persona;

use App\Http\Controllers\Controller;
use App\Models\Configuracion\Expedido;
use App\Models\Configuracion\Profesion;
use App\Models\Configuracion\Tipo_empresa;
use App\Models\Configuracion\Zonas;
use App\Models\Persona\Juridica;
use App\Models\Persona\Natural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Controlador_persona extends Controller{
    /**
     * @version 1.0
     * @author  Colocar nombre del autor <coreo@gmail.com>
     * @param Controlador Administracion de la parte del registro de personas Naturales y Juridicas
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */

    /**
     * PERSONAS NATURALES
     */
    public function persona_natural(){
        $data['menu']               = '11';
        $data['expedido']           = Expedido::get();
        $data['profesion']          = Profesion::get();
        $data['zonas']              = Zonas::get();
        $data['listar_persona_natural']    = Natural::get();
        return view('administrador.recaudaciones.persona.natural', $data);
    }

    //para listar las personas naturales
    public function personaNatural_listar(){
        $persona_natural = Natural::with(['expedido','profesion','zona'])->get();
        return response()->json($persona_natural);
    }

    //para validar ci
    public function personaNatural_validar(Request $request){
        $persona_natural = Natural::where('ci', 'like', $request->ci)->get();
        if ($persona_natural->count() > 0) {
            $data = mensaje_mostrar('error', 'El CI ya esta registro, porfavor verifique');
        } else {
            $data = mensaje_mostrar('success', 'Puede seguir');
        }
        return response()->json($data);
    }
    //Para guardar la persona natural
    public function personaNatural_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'ci'                => 'required|unique:nl_persona_natural,ci',
            'expedido'          =>  'required',
            'nombres'           =>  'required',
            'apellido_paterno'  =>  'required',
            'genero'            =>  'required',
            'estado_civil'      =>  'required',
            'email_persona'     =>  'required|email',
            'celular_persona'   =>  'required|numeric',
            'numero_referencia' =>  'required|numeric',
            'zona'              =>  'required',
            'direccion'         =>  'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $persona_natural                        = new Natural;
            $persona_natural->ci                    = $request->ci;
            $persona_natural->complemento           = $request->complemento;
            $persona_natural->nombres               = $request->nombres;
            $persona_natural->apellido_paterno      = $request->apellido_paterno;
            $persona_natural->apellido_materno      = $request->apellido_materno;
            $persona_natural->genero                = $request->genero;
            $persona_natural->estado_civil          = $request->estado_civil;
            $persona_natural->email                 = $request->email_persona;
            $persona_natural->celular               = $request->celular_persona;
            $persona_natural->celular_referencia    = $request->numero_referencia;
            $persona_natural->id_zona               = $request->zona;
            $persona_natural->id_expedido           = $request->expedido;
            $persona_natural->direccion             = $request->direccion;
            $persona_natural->informacion_adicional = $request->informacion_adicional;
            $persona_natural->id_usuario            = Auth::id();
            $persona_natural->save();

            $persona_natural->profesion()->attach($request->profesion);

            if($persona_natural->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }

    //editar persona natural
    public function personaNatural_editar(Request $request){
        $persona_natural = Natural::with(['expedido', 'profesion', 'zona'])->find($request->id);
        if($persona_natural){
            $data = mensaje_mostrar('success', $persona_natural);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }

    //para guardar lo editado
    public function personaNatural_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'expedido_'          =>  'required',
            'nombres_'           =>  'required',
            'apellido_paterno_'  =>  'required',
            'genero_'            =>  'required',
            'estado_civil_'      =>  'required',
            'email_persona_'     =>  'required|email',
            'celular_persona_'   =>  'required|numeric',
            'numero_referencia_' =>  'required|numeric',
            'zona_'              =>  'required',
            'direccion_'         =>  'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $persona_natural                        = Natural::find($request->id);
            $persona_natural->complemento           = $request->complemento_;
            $persona_natural->nombres               = $request->nombres_;
            $persona_natural->apellido_paterno      = $request->apellido_paterno_;
            $persona_natural->apellido_materno      = $request->apellido_materno_;
            $persona_natural->genero                = $request->genero_;
            $persona_natural->estado_civil          = $request->estado_civil_;
            $persona_natural->email                 = $request->email_persona_;
            $persona_natural->celular               = $request->celular_persona_;
            $persona_natural->celular_referencia    = $request->numero_referencia_;
            $persona_natural->id_zona               = $request->zona_;
            $persona_natural->id_expedido           = $request->expedido_;
            $persona_natural->direccion             = $request->direccion_;
            $persona_natural->informacion_adicional = $request->informacion_adicional_;
            $persona_natural->id_usuario            = Auth::id();
            $persona_natural->save();

            $persona_natural->profesion()->sync($request->profesion_edi);

            if($persona_natural->id){
                $data = mensaje_mostrar('success', 'Se editó los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar');
            }
        }
        return response()->json($data);
    }

    //para vizualizar
    public function personaNatural_vizualizar(Request $request){
        $data['persona_nat'] = Natural::with(['expedido', 'profesion', 'zona'])->find($request->id);
        return view('administrador.recaudaciones.persona.natural_ver', $data);
    }

    //para eliminar el registro
    public function personaNatural_eliminar(Request $request){
        try {
            $persona_natural = Natural::find($request->id);
            if($persona_natural->delete()){
                $data = mensaje_mostrar('success', 'El registro se eliminó con éxito');
            } else {
                $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
        }
        return response()->json($data);
    }
    /**
     * FIN DE LAS PERSONAS NATURALES
     */

    /**
     * PERSONAS JURIDICAS
     */
    public function persona_juridica(){
        $data['menu'] = '12';
        $data['tipo_empresa'] = Tipo_empresa::get();
        return view('administrador.recaudaciones.persona.juridica', $data);
    }

    //para validar ci para el representante legal
    public function persona_juridica_validar(Request $request){
        $persona_natural = Natural::where('ci', 'like', $request->ci)->get();
        if ($persona_natural->count() > 0) {
            $data = mensaje_mostrar('success', $persona_natural);
        } else {
            $data = mensaje_mostrar('error', 'El ci que ingreso no se encuentra registrado!');
        }
        return response()->json($data);
    }
    //para guardaruna persona juridica
    public function persona_juridica_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'tipo_empresa'          =>  'required',
            /* 'numero_testimonio'     =>  'required',
            'testimonio'            =>  'required|file', */
            'nit'                   =>  'required|unique:nl_persona_juridica,nit',
            'nombre'                =>  'required|unique:nl_persona_juridica,nombre_empresa',
            'telefono'              =>  'required|numeric',
            'celular_empresa'       =>  'required|numeric',
            'email_empresa'         =>  'required|email',
            'fecha_constitucion'    =>  'required|date',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{

            //vamos a recivir el pdf
            $pdf            = $request->file('testimonio');

            if ($request->hasFile('testimonio') && $pdf->isValid()) {
                $ruta_pdf = 'testimonio/';
                $testimonio_doc = date('YmdHis') . '.pdf';
                $pdf->move($ruta_pdf, $testimonio_doc);
            } else {
                $testimonio_doc = '';
            }

            /* $ruta_pdf       = 'testimonio/';
            $testimonio_doc = date('YmdHis').'.pdf';
            $pdf->move($ruta_pdf, $testimonio_doc); */

            $persona_juridica                           = new Juridica;
            $persona_juridica->nombre_empresa           = $request->nombre;
            $persona_juridica->email                    = $request->email_empresa;
            $persona_juridica->telefono                 = $request->telefono;
            $persona_juridica->celular                  = $request->celular_empresa;
            $persona_juridica->nit                      = $request->nit;
            $persona_juridica->fecha_constitucion       = $request->fecha_constitucion;
            $persona_juridica->actividad_economica      = $request->actividad_economica;
            $persona_juridica->numero_testimonio        = $request->numero_testimonio;
            $persona_juridica->testimonio               = $testimonio_doc;
            $persona_juridica->id_representante_legal   = $request->id_repre;
            $persona_juridica->id_tipo_empresa          = $request->tipo_empresa;
            $persona_juridica->id_usuario               = Auth::id();
            $persona_juridica->save();

            if($persona_juridica->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }

    //para listar la persona juridicas
    public function persona_juridica_listar(){
        $persona_juridica = Juridica::with(['tipo_empresa','representante_legal'])->get();
        return response()->json($persona_juridica);
    }

    //para eliminar la persona juridica
    public function persona_juridica_eliminar(Request $request){
        try {
            $persona_juridica = Juridica::find($request->id);
            $ubicacion = public_path('testimonio/'.$persona_juridica->testimonio);
            unlink($ubicacion);
            if($persona_juridica->delete()){
                $data = mensaje_mostrar('success', 'El registro se eliminó con éxito');
            } else {
                $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
            }
        } catch (\Throwable $th) {
            $data = mensaje_mostrar('error', 'Ocurrio un problema al eliminar');
        }
        return response()->json($data);
    }

    //para editar la persona juridica
    public function persona_juridica_editar(Request $request){
        $persona_juridica = Juridica::with(['tipo_empresa','representante_legal'])->find($request->id);
        if($persona_juridica){
            $data = mensaje_mostrar('success', $persona_juridica);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para guardar o editado de la persona juridica
    public function persona_juridica_uptate(Request $request){
        $validar = Validator::make($request->all(),[
            'tipo_empresa_'          =>  'required',
            /* 'numero_testimonio_'     =>  'required', */
            /* 'testimonio_'            =>  'required|file', */
            'nit_'                   =>  'required|unique:nl_persona_juridica,nit,'.$request->id_persona_juridica,
            'nombre_'                =>  'required|unique:nl_persona_juridica,nombre_empresa,'.$request->id_persona_juridica,
            'telefono_'              =>  'required|numeric',
            'celular_empresa_'       =>  'required|numeric',
            'email_empresa_'         =>  'required|email',
            'fecha_constitucion_'    =>  'required|date',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            //vamos a recivir el pdf




            $persona_juridica                           = Juridica::find($request->id_persona_juridica);
            $persona_juridica->nombre_empresa           = $request->nombre_;
            $persona_juridica->email                    = $request->email_empresa_;
            $persona_juridica->telefono                 = $request->telefono_;
            $persona_juridica->celular                  = $request->celular_empresa_;
            $persona_juridica->nit                      = $request->nit_;
            $persona_juridica->fecha_constitucion       = $request->fecha_constitucion_;
            $persona_juridica->actividad_economica      = $request->actividad_economica_;
            $persona_juridica->numero_testimonio        = $request->numero_testimonio_;


            $valor_e = '';
            if(!is_null($request->file('testimonio_'))){
                if($persona_juridica->testimonio!= null && $persona_juridica->testimonio!= ''){
                    $ubicacion = public_path('testimonio/'.$persona_juridica->testimonio);
                    unlink($ubicacion);
                }
                $pdf            = $request->file('testimonio_');
                $ruta_pdf       = 'testimonio/';
                $testimonio_doc = date('YmdHis').'.pdf';
                $pdf->move($ruta_pdf, $testimonio_doc);
                $valor_e = 1;
            }else{
                $valor_e = 0;
            }


            if($valor_e == 1){
                $persona_juridica->testimonio               = $testimonio_doc;
            }


            if($request->id_repre_edi != null|| $request->id_repre_edi != ''){
                $persona_juridica->id_representante_legal   = $request->id_repre_edi;
            }
            $persona_juridica->id_tipo_empresa          = $request->tipo_empresa_;
            $persona_juridica->id_usuario               = Auth::id();
            $persona_juridica->save();

            if($persona_juridica->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para vizualizar persona juridica
    public function persona_juridica_vizualizar(Request $request){
        $data['persona_ju'] = Juridica::with(['tipo_empresa', 'representante_legal'=>function ($q1){
            $q1->with(['expedido', 'profesion', 'zona']);
        }])->find($request->id);
        return view('administrador.recaudaciones.persona.juridica_ver', $data);
    }
    /**
     * FIN DE LAS PERSONAS JURIDICAS
     */
}
