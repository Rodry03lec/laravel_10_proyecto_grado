<?php

namespace App\Models\Servicio;

use App\Models\Configuracion\Tipo_propiedad;
use App\Models\Configuracion\Zonas;
use App\Models\Persona\Juridica;
use App\Models\Persona\Natural;
use App\Models\Servicio\Categoria_servicio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Instalacion extends Model
{
    use HasFactory;
    protected $table = 'nl_instalacion';
    protected $fillable=[
        'direccion',
        'fecha_instalacion',
        'fecha_conclucion',
        'estado_instalacion',
        'corte',
        'monto_instalacion',
        'glosa',
        'id_zona',
        'id_persona_natural',
        'id_persona_juridica',
        'id_categoria',
        'id_propiedad',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    protected function montoinstalacion():Attribute{
        return new Attribute(
            get: fn ($value) => con_separador_comas($value),
        );
    }


    //relacion reversa on nl_zonas
    public function zona(){
        return $this->belongsTo(Zonas::class, 'id_zona', 'id');
    }

    //relacion reversa con nl_persona_natural
    public function persona_natural(){
        return $this->belongsTo(Natural::class, 'id_persona_natural', 'id');
    }

    //relacion reversa con nl_persona_juridica
    public function persona_juridica(){
        return $this->belongsTo(Juridica::class, 'id_persona_juridica', 'id');
    }

    //relacion reversa con nl_categoria
    public function categoria(){
        return $this->belongsTo(Categoria_servicio::class, 'id_categoria', 'id');
    }

    //relacion reversa con nl_tipo_propiedad
    public function tipo_propiedad(){
        return $this->belongsTo(Tipo_propiedad::class, 'id_propiedad', 'id');
    }
}
