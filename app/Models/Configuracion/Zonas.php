<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Configuracion\Tipo_zona;
use App\Models\Servicio\Instalacion;

class Zonas extends Model
{
    use HasFactory;
    protected $table = 'nl_zonas';
    protected $fillable=[
        'nombre',
        'descripcion',
        'fecha_creacion',
        'ultima_actualizacion',
        'id_tipo_zona'
    ];

    //creamos la relacion de uno a muchos
    public function relacion_tipo_zona(){
        return $this->hasMany(Tipo_zona::class, 'id', 'id_tipo_zona');
    }

    //relacion con nl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_zona', 'id');
    }
}
