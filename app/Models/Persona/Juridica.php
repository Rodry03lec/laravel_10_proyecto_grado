<?php

namespace App\Models\Persona;

use App\Models\Configuracion\Tipo_empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona\Natural;
use App\Models\Servicio\Instalacion;

class Juridica extends Model
{
    use HasFactory;

    protected $table = 'nl_persona_juridica';
    protected $fillable=[
        'nombre_empresa',
        'email',
        'telefono',
        'celular',
        'nit',
        'fecha_constitucion',
        'actividad_economica',
        'numero_testimonio',
        'testimonio',
        'id_representante_legal',
        'id_asesor',
        'id_tipo_empresa',
        'id_usuario',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion reversa de tipo de empresa
    public function tipo_empresa(){
        return $this->belongsTo(Tipo_empresa::class, 'id_tipo_empresa', 'id');
    }

    //relacion reversa de persona natural representante legal
    public function representante_legal(){
        return $this->belongsTo(Natural::class, 'id_representante_legal', 'id');
    }
    //relacion reversa de persona natural asesor
    public function asesor(){
        return $this->belongsTo(Natural::class, 'id_asesor', 'id');
    }
    //relacion con nl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_persona_juridica', 'id');
    }
}
