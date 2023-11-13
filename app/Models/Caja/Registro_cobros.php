<?php

namespace App\Models\Caja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caja\Facturacion;
use App\Models\Servicio\Instalacion;

class Registro_cobros extends Model
{
    use HasFactory;
    protected $table = 'nl_registro_cobros';
    protected $fillable=[
        'numero_mes',
        'fecha',
        'descripcion',
        'estado',
        'id_instalacion',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';
    //relacion con caturacion
    public function facturacion(){
        return $this->hasMany(Facturacion::class, 'id_registro_cobro', 'id');
    }
    //relacion reversa nl_instalacion
    public function instlacion(){
        return $this->belongsTo(Instalacion::class, 'id_instalacion', 'id');
    }
}
