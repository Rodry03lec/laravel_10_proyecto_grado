<?php

namespace App\Models\Personal;

use App\Models\Persona\Natural;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\Cargo;
use App\Models\Servicio\Instalacion;

class Personal_trabajo extends Model
{
    use HasFactory;
    protected $table = 'nl_personal_trabajo';
    protected $fillable=[
        'fecha_contratacion',
        'fecha_finalizacion',
        'estado',
        'referencia_laboral',
        'referencia_nombre',
        'descripcion',
        'id_persona',
        'id_cargo',
        'id_usuario'
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion reversa de nl_cargo
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id');
    }
    //relacion reversa con la persona natural
    public function persona_natural(){
        return $this->belongsTo(Natural::class, 'id_persona', 'id');
    }

    //relacion con nl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_personal_trabajo', 'id');
    }
}
