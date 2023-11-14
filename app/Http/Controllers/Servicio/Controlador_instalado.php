<?php

namespace App\Http\Controllers\Servicio;

use App\Http\Controllers\Controller;
use App\Models\Caja\Registro_cobros;
use App\Models\Servicio\Instalacion;
use Illuminate\Http\Request;

class Controlador_instalado extends Controller
{
    //

    public function instalados(){
        $data['menu'] = 16;
        return view('administrador.recaudaciones.servicios.instalados', $data);
    }

    //para listar los erivicios instalados
    public function instalados_activos(Request $request){

        $registro = Registro_cobros::with(['instalacion'=>function($q1){
            $q1->with(['persona_natural'=>function($q2){
                $q2->with(['expedido']);
            },'persona_juridica'=>function($q3){
                $q3->with(['representante_legal'=>function($q4){
                    $q4->with(['expedido']);
                }]);
            } ]);
            $q1->where('estado_instalacion', 'finalizado');
        }])
                ->where('estado', 'activo')
                ->get();

        return response()->json($registro);
    }

    public function instalados_inactivos(){
        $registro = Registro_cobros::with(['instalacion'=>function($q1){
            $q1->with(['persona_natural'=>function($q2){
                $q2->with(['expedido']);
            },'persona_juridica'=>function($q3){
                $q3->with(['representante_legal'=>function($q4){
                    $q4->with(['expedido']);
                }]);
            } ]);
            $q1->where('estado_instalacion', 'finalizado');
        }])
                ->where('estado', 'inactivo')
                ->get();

        return response()->json($registro);
    }

    //para ver el instalado
    public function ver_instalado(Request $request){
        $id_encriptado = encriptar($request->id);
        if($id_encriptado){
            $data = mensaje_mostrar('success', $id_encriptado);
        }else{
            $data = mensaje_mostrar('error', 'Ocurrio un error al encriptar');
        }
        return response()->json($data);
    }
}
