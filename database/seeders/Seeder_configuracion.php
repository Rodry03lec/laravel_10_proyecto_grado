<?php

namespace Database\Seeders;

use App\Models\Configuracion\Expedido;
use App\Models\Configuracion\Profesion;
use App\Models\Configuracion\Tipo_empresa;
use App\Models\Configuracion\Tipo_propiedad;
use App\Models\Configuracion\Tipo_zona;
use App\Models\Configuracion\Zonas;
use App\Models\Gestion;
use App\Models\Mes;
use App\Models\Servicio\Categoria_servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Seeder_configuracion extends Seeder
{
    public function run(): void
    {
        $gestiones = array('2015','2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023','2024','2025');

        foreach($gestiones as $g){
            $gestion = new Gestion;
            $gestion->gestion = $g;
            $gestion->estado = 'activo';
            $gestion->save();
        }



        //para guardar lo que contendra
        $array_categoria = array(
            array(
                'nombre'=>'Familia Básica',
                'precio_fijo'=> 15,
            ),
            array(
                'nombre'=>'Familiar',
                'precio_fijo'=> 20,
            ),
            array(
                'nombre'=>'Comercio',
                'precio_fijo'=> 25,
            ),
            array(
                'nombre'=>'Baño',
                'precio_fijo'=> 30,
            ),
            array(
                'nombre'=>'Piscina',
                'precio_fijo'=> 40,
            ),
        );


        foreach ($array_categoria as $val) {
            $categoria              = new Categoria_servicio;
            $categoria->nombre      = $val['nombre'];
            //$categoria->precio_fijo = sin_separador_comas($val['precio_fijo']);
            //$categoria->id_gestion  = 1;
            $categoria->save();
        }


        //para guardar el mes
        $mes = array(
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        );

        $con = 1;
        foreach ($mes as $val) {
            $nuevo_mes = new Mes;
            $nuevo_mes->numero_mes = $con;
            $nuevo_mes->nombre_mes = $val;
            $nuevo_mes->save();
            $con++;
        }



        //para llenar las profesiones
        $profesiones = array(
            'Albañil',
            'Comerciante',
            'Médico',
            'Enfermero/a',
            'Profesor/a',
            'Abogado/a',
            'Ingeniero/a',
            'Arquitecto/a',
            'Contador/a',
            'Programador/a',
            'Diseñador/a gráfico/a',
            'Chef',
            'Psicólogo/a',
            'Periodista',
            'Actor/actriz',
            'Músico/a',
            'Electricista',
            'Plomero/a',
            'Carpintero/a',
            'Mecánico/a',
            'Peluquero/a',
            'Consultor/a de negocios',
            'Agente inmobiliario/a',
            'Analista financiero/a',
            'Investigador/a científico/a',
            'Trabajador/a social',
            'Bombero/a',
            'Policía',
            'Piloto/a',
            'Astronauta',
            'Artista plástico/a',
            'Fotógrafo/a',
            'Geólogo/a',
            'Biólogo/a',
            'Químico/a',
            'Agricultor/a',
            'Marinero/a',
            'Psiquiatra',
            'Economista',
            'Electricista de automóviles',
            'Mecánico',
            'Decorador/a de interiores',
            'Técnico/a de farmacia',
            'Dentista',
            'Cirujano/a',
            'Analista de sistemas',
            'Trabajador/a de construcción',
        );
        foreach ($profesiones as $val) {
            $profesion = new Profesion;
            $profesion->descripcion = $val;
            $profesion->save();
        }


        //para llenar el tipo de empresa
        $tipos_de_empresas = array(
            array(
                'titulo'=>'Sociedad Anónima (S.A.)',
                'descripcion'=>'Una forma de empresa en la que el capital social está dividido en acciones, y los accionistas tienen responsabilidad limitada.'
            ),
            array(
                'titulo'=>'Sociedad de Responsabilidad Limitada (SRL)',
                'descripcion'=>'Una empresa en la que los socios tienen responsabilidad limitada y el capital social se divide en participaciones.'
            ),
            array(
                'titulo'=>'Empresa Individual de Responsabilidad Limitada (EIRL)',
                'descripcion'=>'Una empresa en la que una sola persona es el único titular de la empresa y tiene responsabilidad limitada.'
            ),
            array(
                'titulo'=>'Corporación',
                'descripcion'=>'Una entidad legal separada de sus propietarios que tiene responsabilidad limitada y puede emitir acciones.'
            ),
            array(
                'titulo'=>'Cooperativa',
                'descripcion'=>'Una entidad en la que los miembros son propietarios y participan en la toma de decisiones y en las ganancias.'
            ),
            array(
                'titulo'=>'Asociación sin Fines de Lucro',
                'descripcion'=>'Una organización que opera con fines benéficos o sociales, no con fines de lucro.'
            ),
            array(
                'titulo'=>'Fundación',
                'descripcion'=>'Una entidad sin fines de lucro que se establece con un propósito específico, como la caridad o la educación.'
            ),
            array(
                'titulo'=>'Sucursal',
                'descripcion'=>'Una entidad que opera como una extensión de una empresa matriz en un lugar diferente.'
            ),
            array(
                'titulo'=>'Entidad Extranjera',
                'descripcion'=>'Una empresa extranjera que opera en un país diferente al de su sede central.'
            ),
            array(
                'titulo'=>'Microempresa',
                'descripcion'=>'Una empresa pequeña con ingresos y activos limitados.'
            ),
            array(
                'titulo'=>'Pequeña y Mediana Empresa (Pyme)',
                'descripcion'=>'Empresas que no son microempresas pero aún tienen un tamaño modesto.'
            ),
            array(
                'titulo'=>'Entidad financiera',
                'descripcion'=>'proporciona servicios financieros a individuos, empresas y otras organizaciones, y juega un papel fundamental en la economía al facilitar el flujo de dinero y crédito.'
            ),
        );

        foreach($tipos_de_empresas as $lis){
            $tipo_empresa               = new Tipo_empresa;
            $tipo_empresa->titulo       = $lis['titulo'];
            $tipo_empresa->descripcion  = $lis['descripcion'];
            $tipo_empresa->save();
        }

        //para el expedido
        $lis_expedido = array(
            array(
                'sigla'=>'LP',
                'descripcion'=>'La Paz'
            ),
            array(
                'sigla'=>'CBB',
                'descripcion'=>'Cochabamba '
            ),
            array(
                'sigla'=>'BEN',
                'descripcion'=>'Beni'
            ),
            array(
                'sigla'=>'OR',
                'descripcion'=>'Oruro'
            ),
            array(
                'sigla'=>'CHU',
                'descripcion'=>'Chuquisaca'
            ),
            array(
                'sigla'=>'PD',
                'descripcion'=>'Pando'
            ),
            array(
                'sigla'=>'PT',
                'descripcion'=>'Potosí'
            ),
            array(
                'sigla'=>'SC',
                'descripcion'=>'Santa Cruz'
            ),
            array(
                'sigla'=>'TJ',
                'descripcion'=>'Tarija'
            ),
            array(
                'sigla'=>'Otros',
                'descripcion'=>'Otros'
            ),
        );

        foreach ($lis_expedido as $val) {
            $expedido = new Expedido;
            $expedido->sigla = $val['sigla'];
            $expedido->descripcion = $val['descripcion'];
            $expedido->save();
        }


        //para guardar el tipo de zona
        $tipo_zona = array(
            'Residencial',
            'Comercial',
            'Industrial',
            'Rural',
            'Turística',
            'Educativa',
            'Sanitaria',
            'Histórica',
            'Gastronómica',
            'Gubernamental',
            'Comunitaria',
            'Reserva Natural',
        );
        foreach($tipo_zona as $lis){
            $tipo_zo = new Tipo_zona;
            $tipo_zo->nombre = $lis;
            $tipo_zo->save();
        }


        //para registrar las zonas
        $zonas = array(
            array(
                'nombre'                => 'Zona urbana',
                'descripcion'           => 'Capital del municipio, centro de gobierno, comercio y servicios: Cultura, gastronomía, compras',
                'fecha_creacion'        => date('1552-11-02'),
                'ultima_actualizacion'  => date('Y-m-d'),
                'id_tipo_zona'          => 1,
            ),
            array(
                'nombre'                => 'Rural',
                'descripcion'           => 'Montañas que rodean la ciudad, agricultura y ganadería: Naturaleza, caminatas, camping, observación de aves',
                'fecha_creacion'        => date('10000-01-01'),
                'ultima_actualizacion'  => date('Y-m-d'),
                'id_tipo_zona'          => 5,
            ),
            array(
                'nombre'                => 'Amortiguamiento del Parque Nacional Isiboro Sécure',
                'descripcion'           => 'Hogar de una gran variedad de flora y fauna: Ecoturismo, caminatas, camping, observación de aves ',
                'fecha_creacion'        => date('1965-07-01'),
                'ultima_actualizacion'  => date('Y-m-d'),
                'id_tipo_zona'          => 8,
            ),
        );

        foreach ($zonas as $lis) {
            $zonas_guardar                          = new Zonas();
            $zonas_guardar->nombre                  = $lis['nombre'];
            $zonas_guardar->descripcion             = $lis['descripcion'];
            $zonas_guardar->fecha_creacion          = $lis['fecha_creacion'];
            $zonas_guardar->ultima_actualizacion    = $lis['ultima_actualizacion'];
            $zonas_guardar->id_tipo_zona            = $lis['id_tipo_zona'];
            $zonas_guardar->save();
        }


        //para registrar el tipo de propiedad
        $lis_propiedad = array(
            array(
                'titulo'=>'Alquilada',
                'descripcion'=>'Cuando una propiedad es alquilada, el propietario permite que un inquilino viva en la propiedad a cambio de un alquiler periódico.'
            ),
            array(
                'titulo'=>'Propia',
                'descripcion'=>'Cuando una propiedad es propia, significa que el propietario tiene el título de propiedad completo y no la alquila a nadie más. La propiedad pertenece al propietario de forma permanente.'
            ),
            array(
                'titulo'=>'Compartida',
                'descripcion'=>'Cuando dos o más personas comparten la propiedad de una vivienda, por ejemplo, en una propiedad conjunta o copropiedad.'
            ),
            array(
                'titulo'=>'Hipotecada',
                'descripcion'=>'Cuando el propietario ha tomado una hipoteca o préstamo para comprar la propiedad y aún está pagando esa deuda.'
            ),
            array(
                'titulo'=>'Heredada',
                'descripcion'=>'Cuando una propiedad es transferida a través de una herencia después del fallecimiento del propietario anterior.'
            ),
            array(
                'titulo'=>'Vivienda de temporada',
                'descripcion'=>'Algunas propiedades se utilizan solo durante ciertas épocas del año, como viviendas de playa o de montaña.'
            ),
            array(
                'titulo'=>'En venta',
                'descripcion'=>'Cuando una propiedad se encuentra en el mercado y el propietario está tratando de venderla'
            ),
            array(
                'titulo'=>'Abandonada',
                'descripcion'=>'Cuando una propiedad está desocupada y sin mantenimiento durante un período prolongado.'
            ),
        );

        foreach($lis_propiedad as $lis){
            $tipo_propiedad                 = new Tipo_propiedad;
            $tipo_propiedad->titulo         = $lis['titulo'];
            $tipo_propiedad->descripcion    = $lis['descripcion'];
            $tipo_propiedad->save();
        }
    }
}
