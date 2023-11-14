<?php

namespace App\Http\Controllers\Caja;

use App\Http\Controllers\Controller;
use App\Models\Caja\Facturacion;
use App\Models\Caja\Registro_cobros;
use App\Models\Gestion;
use App\Models\Mes;
use App\Models\Persona\Juridica;
use App\Models\Persona\Natural;
use App\Models\Servicio\Instalacion;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class Controlador_cobro extends Controller
{
    //
    public function cobros_busqueda(){
        $data['menu'] = 17;
        return view('administrador.caja.cobros', $data);
    }

    //para buscar po ci
    public function busqueda_ci(Request $request){
        $ci = $request->ci;
        $persona_natural = Natural::with(['expedido'])->where('ci', 'like', $ci)->get();
        if($persona_natural->count() > 0){
            $instalacion = Instalacion::with(['persona_natural','persona_juridica','registro_cobros'=>function($q){
                $q->where('estado','activo');
            }])->where('id_persona', $persona_natural[0]->id)
            ->where('estado_instalacion', 'finalizado')
            ->get();
        }else{
            $instalacion = null;
            $persona_natural = null;
        }

        $data['instalacion'] = $instalacion;
        $data['persona'] = $persona_natural;
        return view('administrador.caja.busqueda_vista', $data);
    }

    //para realizar los cobros corespondientes
    public function cobros($id){
        $id_descript = desencriptar($id);
        $instalacion = Instalacion::with(['sub_categoria','registro_cobros'=>function($q1){
            $q1->with(['facturacion'=>function($q2){
                $q2->with(['gestion','mes','caja_detalle']);
            }]);
        },'persona_natural','persona_juridica'])->find($id_descript);

        $persona = Natural::with(['expedido'])->find($instalacion->id_persona);
        $data['instalacion'] = $instalacion;
        $data['menu'] = 17;
        $data['gestion'] = Gestion::where('estado','activo')->get();
        $data['mes'] = Mes::get();
        $data['mes_unico'] = Mes::find($instalacion->registro_cobros->numero_mes);
        $data['persona'] = $persona;
        return view('administrador.caja.cobros_especificos', $data);
    }

    //para listar la gestion
    public function listar_gestion(){
        $gestion = Gestion::where('estado','activo')->get();
        if($gestion){
            $data = mensaje_mostrar('success', $gestion);
        }else{
            $data = mensaje_mostrar('success', 'Ocurrio un error al mostrar');
        }
        return response()->json($data);
    }

    public function cobro_gestion(Request $request){
        $id_gestion = $request->id_gestion;
        $id_registro_cobro = $request->id_registro_cobro;

        $gestion = Gestion::find($id_gestion);

        $registro_cobro = Registro_cobros::with(['facturacion'=>function($q){
            $q->with(['gestion','mes']);
        }])->find($id_registro_cobro);

        $data['gestion_lis']    = $gestion;
        $data['mes_lis']        = Mes::get();
        $data['registro_cobro'] = $registro_cobro;

        $facturacion = Facturacion::where('id_gestion', $gestion->id)->get();
        $data['facturacion'] = $facturacion;
        return view('administrador.caja.cobro_mes', $data);
    }

    //para el cobro anual
    public function cobro_anual(Request $request){
        $id_gestion =  $request->id_gestion;

        $gestion = Gestion::find($id_gestion);
        $id_registro_cobro =  $request->id_registro_cobro;
        $registro_cobro = Registro_cobros::with(['facturacion'=>function($q){
            $q->with(['gestion','mes']);
        }])->find($id_registro_cobro);

        $data['gestion_anual']          = $gestion;
        $data['registro_cobro_anual']   = $registro_cobro;
    }
}
