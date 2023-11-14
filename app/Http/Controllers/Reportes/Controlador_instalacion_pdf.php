<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Models\Servicio\Instalacion;
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
}
