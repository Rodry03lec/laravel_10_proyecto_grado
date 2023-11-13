<?php

namespace App\Models\Caja;

use App\Models\Gestion;
use App\Models\Mes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caja\Registro_cobros;
use App\Models\Caja\Caja_detalle;


class Facturacion extends Model
{
    use HasFactory;
    protected $table = 'nl_facturacion';
    protected $fillable=[
        'numero_factura',
        'id_gestion',
        'id_mes',
        'fecha',
        'id_registro_cobro',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion reversa nl_gestion
    public function gestion() {
        return $this->belongsTo(Gestion::class, 'id_gestion', 'id');
    }
    //relacion reversa de nl_mes
    public function mes() {
        return $this->belongsTo(Mes::class, 'id_mes', 'id');
    }
    //relacion reversa de nl_registro_cobros
    public function registro_cobros() {
        return $this->belongsTo(Registro_cobros::class, 'id_registro_cobro', 'id');
    }
    //relacion con con nl_caja_detalle
    public function caja_detalle(){
        return $this->hasOne(Caja_detalle::class, 'id_factura', 'id');
    }
}
