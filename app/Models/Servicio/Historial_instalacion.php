<?php

namespace App\Models\Servicio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio\Instalacion;

class Historial_instalacion extends Model
{
    use HasFactory;
    protected $table = 'nl_instalacion_historial';
    protected $fillable=[
        'fecha',
        'descripcion',
        'id_usuario',
        'id_instalacion',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    public function instalacion(){
        return $this->belongsTo(Instalacion::class, 'id_instalacion', 'id');
    }
}
