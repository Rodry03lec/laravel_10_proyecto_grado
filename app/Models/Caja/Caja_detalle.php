<?php

namespace App\Models\Caja;

use App\Models\Servicio\Instalacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja_detalle extends Model
{
    use HasFactory;
    protected $table = 'nl_caja_detalle';
    protected $fillable=[
        'fecha',
        'concepto',
        'moneda',
        'monto_ingreso',
        'monto_salida',
        'importe',
        'estado',
        'id_usuario',
        'id_instalacion',
        'id_cobro',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion reversa con nl_instalacion
    public function instalacion(){
        return $this->belongsTo(Instalacion::class, 'id_instalacion', 'id');
    }
}
