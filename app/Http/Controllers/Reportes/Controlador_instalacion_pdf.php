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

class Controlador_instalacion_pdf extends Controller{
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


        /* $factura = Facturacion::with(['gestion','mes','registro_cobros'=>function($rc){
            $rc->with(['instalacion'=>function($i){
                $i->with(['zona','persona_natural'=>function($pn){
                    $pn->with(['expedido']);
                },'persona_juridica'=>function($pj){
                    $pj->with(['representante_legal'=>function($rl){
                        $rl->with(['expedido']);
                    },'tipo_empresa']);
                },'sub_categoria','tipo_propiedad','']);
            }]);
        },'caja_detalle'])->find($id_factura); */

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
}
