<?php

namespace App\Models\Persona;

use App\Models\Configuracion\Expedido;
use App\Models\Configuracion\Profesion;
use App\Models\Configuracion\Zonas;
use App\Models\Personal\Personal_trabajo;
use App\Models\Servicio\Instalacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Natural extends Model
{
    use HasFactory;

    protected $table = 'nl_persona_natural';
    protected $fillable=[
        'ci',
        'complemento',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'genero',
        'celular',
        'celular_referencia',
        'estado_civil',
        'informacion_adicional',
        'direccion',
        'foto',
        'id_expedido',
        'id_zona',
        'id_usuario',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';


    //para que registre las en mayusculas
    protected function nombres():Attribute{
        return new Attribute(
            set: fn ($value) => mb_strtoupper($value),
            get: fn ($value) => $value,
        );
    }
    protected function apellidopaterno():Attribute{
        return new Attribute(
            set: fn ($value) => mb_strtoupper($value),
            get: fn ($value) => $value,
        );
    }
    protected function apellidomaterno():Attribute{
        return new Attribute(
            set: fn ($value) => mb_strtoupper($value),
            get: fn ($value) => $value,
        );
    }


    //relacion reversa de expedido
    public function expedido(){
        return $this->belongsTo(Expedido::class, 'id_expedido', 'id');
    }

    //relacion de muchos a muchos con profesion
    public function profesion(){
        return $this->belongsToMany(Profesion::class, 'natural_profesion', 'id_persona_natural', 'id_profesion');
    }



    //relacion reverza con zona
    public function zona(){
        return $this->belongsTo(Zonas::class, 'id_zona', 'id');
    }

    //relacion con persona juridica para el id_representante_legal
    public function juridica_representante_legal(){
        return $this->hasMany(Juridica::class, 'id_representante_legal', 'id');
    }

    //relacion con persona juridica para el id asesor
    public function juridica_asesor(){
        return $this->hasMany(Juridica::class, 'id_asesor', 'id');
    }

    //relacion con con nl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_persona_natural', 'id');
    }

    //relacion de uno a muchos con personal trabajo
    public function personal_trabajo(){
        return $this->hasMany(Personal_trabajo::class, 'id_persona', 'id');
    }
}
