<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Caja\Facturacion;
use App\Models\Servicio\Instalacion;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Gestion;
use App\Models\Mes;
use App\Models\Caja\Registro_cobros;

class Controlador_instalacion_pdf extends Controller{

    /**
     * @version 1.0
     * @author  Noemi Liz Solarez Chico <noemilizsolarez@gmail.com>
     * @param Controlador Administrar diferentes reportes que necesita el sistema
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */

    //para los pdf
    public function registro_documento($id){
        $id_descript = desencriptar($id);

        $instalacion = Instalacion::with(['zona','persona_natural'=>function($pn){
            $pn->with(['expedido']);
        },'persona_juridica'=>function($pj){
            $pj->with(['representante_legal'=>function($rl){
                $rl->with(['expedido']);
            }]);
        },'sub_categoria','tipo_propiedad','historial_instalacion','caja_detalle','registro_cobros','personal_trabajo'=>function($q){
            $q->with(['cargo'=>function($c){
                $c->with(['unidad']);
            },'persona_natural'=>function($q1){
                $q1->with(['expedido']);
            }]);
        }])->find($id_descript);

        $data['instalacion'] = $instalacion;

        $options = new Options;
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $data['persona'] = 'Persona';
        $html = View::make('administrador.reportes.registro_documento')->with($data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }


    //para imprimir el comprobante mensual
    public function comprobante_cobro_instalacion($id){
        $id_instalacion = desencriptar($id);

        $instalacion = Instalacion::with(['zona','tipo_propiedad','sub_categoria'=>function($sc){
            $sc->with(['categoria']);
        },'persona_natural'=>function($pn){
            $pn->with(['expedido']);
        },'persona_juridica'=>function($pj){
            $pj->with(['representante_legal'=>function($rl){
                $rl->with(['expedido']);
            }]);
        },'caja_detalle'=>function($cd){
            $cd->where('id_factura',null);
        }])->find($id_instalacion);

        $usuario_registro = User::find($instalacion->id_usuario);

        $data['usuario_registro']   = $usuario_registro;
        $data['instalacion']        = $instalacion;

        $options = new Options;
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $html = View::make('administrador.reportes.comprobante')->with($data)->render();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('letter', 'portrait');
        $dompdf->setPaper('letter');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }

    //para el reporte si pagas mensual
    public function comprobante_cobro_mensual($id){
        $id_factura = desencriptar($id);

        $factura = Facturacion::with(['gestion','mes','registro_cobros'=>function($rc){
            $rc->with(['instalacion'=>function($i){
                $i->with(['sub_categoria','tipo_propiedad','zona','persona_juridica'=>function($pj){
                    $pj->with(['tipo_empresa','representante_legal'=>function($rl){
                        $rl->with(['expedido']);
                    }]);
                },'persona_natural'=>function($pn){
                    $pn->with(['expedido']);
                }]);
            }]);
        },'caja_detalle'])->find($id_factura);

        $data['factura'] = $factura;
        $data['usuario_registro'] = User::find($factura->id_usuario);

        $options = new Options;
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $data['persona'] = 'Rodry';
        $html = View::make('administrador.reportes.comprobante_mensual')->with($data)->render();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('letter', 'portrait');
        $dompdf->setPaper('letter');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }

    //para ver si pagaron en conjunto o anual
    public function comprobante_pago_ver($id_gestion, $id_registro_cobro){
        $id_ges         = desencriptar($id_gestion);
        $id_reg_cobro   = desencriptar($id_registro_cobro);


        $facturacion        = Facturacion::with(['mes', 'caja_detalle'])
                                ->where('id_registro_cobro',$id_reg_cobro)
                                ->where('id_gestion', $id_ges)
                                ->orderBy('id', 'asc')
                                ->get();
        $registro_cobros    = Registro_cobros::with(['instalacion'=>function($i){
            $i->with(['sub_categoria','zona','persona_natural'=>function($pn){
                $pn->with(['expedido']);
            },'persona_juridica'=>function($pj){
                $pj->with(['representante_legal'=>function($rl){
                    $rl->with(['expedido']);
                }]);
            },'personal_trabajo']);
        },'facturacion'=>function($q){
            $q->with(['gestion','mes']);
        }])->find($id_reg_cobro);


        $usuario_registro = User::find($registro_cobros->instalacion->id_usuario);

        $data['usuario_registro']   = $usuario_registro;




        $gestion            = Gestion::find($id_ges);
        $mes                = Mes::orderBy('numero_mes', 'asc')->get();

        $data['facturacion']        = $facturacion;
        $data['registro_cobros']    = $registro_cobros;

        $data['gestion']            = $gestion;
        $data['mes']                = $mes;

        $resultados = [];

        foreach ($mes as $m) {
            // Realizar la consulta según tus condiciones
            $factura_consulta = Facturacion::with(['caja_detalle'])->where('id_gestion', $gestion->id)
                ->where('id_mes', $m->id)
                ->where('id_registro_cobro', $id_reg_cobro)
                ->get();

            // Agregar el resultado al array
            $resultados[] = [
                'mes' => $m,
                'factura_consulta' => $factura_consulta,
            ];
        }
        $data['resultados'] = $resultados;

        //validamos si la persona se registro antes o si es de esaj gestion
        $anio_registrado    = date('Y', strtotime($registro_cobros->fecha));
        $mes_registrado     = $registro_cobros->numero_mes;

        $conta = 0;
        foreach ($resultados as $resultado) {
            if($anio_registrado==$gestion->gestion){
                if($resultado['mes']->numero_mes >= $mes_registrado){
                    $conta = $conta + 1;
                }
            }else{
                $conta = $conta + 1;
            }
        }
        $monto_anual = $registro_cobros->instalacion->sub_categoria->precio_fijo * $conta;
        $data['monto_total_anual'] = $monto_anual;


        $options = new Options;
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        //$data['persona'] = 'Rodry';
        $html = View::make('administrador.reportes.comprobante_anual')->with($data)->render();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('letter', 'portrait');
        $dompdf->setPaper('letter');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }


    //para los deudores pendientes
    public function deudas_ver_anual($id){
        $id_gestion         = desencriptar($id);
        $gestion            = Gestion::find($id_gestion);
        $facturacion        = Facturacion::select('id_registro_cobro')->where('id_gestion', $id_gestion)->groupBy('id_registro_cobro')->get();
        $mes                = Mes::orderBy('numero_mes', 'asc')->get();

        $instalados = Instalacion::with(['persona_natural'=>function($pn){
            $pn->with(['expedido']);
        },'persona_juridica'=>function($pj){
            $pj->with(['representante_legal'=>function($rl){
                $rl->with(['expedido']);
            }]);
        },'sub_categoria','registro_cobros'=>function($rc){
            $rc->with(['facturacion']);
        }])->where('estado_instalacion', 'finalizado')->get();


        $resultados_instalados = [];

        foreach ($instalados as $instalacion) {
            $resultados_meses = [];
            foreach ($mes as $m) {
                // Realizar la consulta según tus condiciones
                $factura_consulta = Facturacion::with(['caja_detalle'])->where('id_gestion', $id_gestion)
                    ->where('id_mes', $m->id)
                    ->where('id_registro_cobro', $instalacion->registro_cobros->id)
                    ->get();

                // Agregar el resultado al array
                $resultados_meses[] = [
                    'mes' => $m,
                    'factura_consulta' => $factura_consulta
                ];
            }
            $resultados_instalados[]=[
                'instalados'=> $instalacion,
                'resultado_meses' => $resultados_meses
            ];
        }
        $data['resultados_instalados'] = $resultados_instalados;
        $data['gestion'] = $gestion;


        $options = new Options;
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        //$data['persona'] = 'Rodry';
        $html = View::make('administrador.reportes.deudas_pendientes')->with($data)->render();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('letter', 'portrait');
        $dompdf->setPaper('letter');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }


    //para ver todos los instalados
    public function ver_instalados(){
        $instalados = Instalacion::with(['sub_categoria','persona_juridica'=>function($pj){
            $pj->with(['representante_legal'=>function($rl){
                $rl->with(['expedido']);
            }]);
        },'persona_natural'=>function($pn){
            $pn->with(['expedido']);
        }])
        ->where('estado_instalacion', 'finalizado')->orderBy('fecha_conclucion','asc')->get();


        $data['instalados'] = $instalados;

        $options = new Options;
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $data['persona'] = 'Rodry';
        $html = View::make('administrador.reportes.listar_instalados')->with($data)->render();
        $dompdf->loadHtml($html);
        //$dompdf->setPaper('letter', 'portrait');
        $dompdf->setPaper('letter');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        return response($pdfContent, 200)->header('Content-Type', 'application/pdf');
    }
}
