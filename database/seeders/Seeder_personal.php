<?php

namespace Database\Seeders;

use App\Models\Personal\Cargo;
use App\Models\Personal\Unidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Seeder_personal extends Seeder{
    public function run(): void
    {
        $unidad = array(
            array(
                'nombre'=>'Área Financiera',
                'descripcion'=>'Se encarga de la administración de los recursos financieros del municipio',
            ),
            array(
                'nombre'=>'Área Técnica',
                'descripcion'=>'Se encarga de la prestación de servicios y obras públicas municipales',
            ),
            array(
                'nombre'=>'Área Social',
                'descripcion'=>'Se encarga de la promoción del desarrollo social del municipio',
            ),
            array(
                'nombre'=>'Área Jurídica',
                'descripcion'=>'Se encarga de la asesoría legal del municipio',
            ),
            array(
                'nombre'=>'Área Administrativa',
                'descripcion'=>'Se encarga de la gestión administrativa del municipio',
            ),
        );
        foreach ($unidad as $lis) {
            $nueva_unidad = new Unidad();
            $nueva_unidad->nombre = $lis['nombre'];
            $nueva_unidad->descripcion = $lis['descripcion'];
            $nueva_unidad->save();
        }


        //ahora para los cargos
        $cargos_area_financiera = array(
            array(
                'nombre'=>'Director de Finanzas',
                'descripcion'=>'Es el responsable de la gestión financiera del municipio',
            ),
            array(
                'nombre'=>'Contabilidad',
                'descripcion'=>'Es el responsable de la contabilidad y la auditoría de los gastos municipales.',
            ),
        );
        foreach ($cargos_area_financiera as $lis) {
            $cargo_area_fin = new Cargo();
            $cargo_area_fin->nombre = $lis['nombre'];
            $cargo_area_fin->descripcion = $lis['descripcion'];
            $cargo_area_fin->id_unidad = 1;
            $cargo_area_fin->save();
        }
    }
}
