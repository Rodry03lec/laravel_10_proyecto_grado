<?php

namespace App\Models\Configuracion;

use App\Models\Persona\Juridica;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_empresa extends Model
{
    use HasFactory;
    protected $table = 'nl_tipo_empresa';
    protected $fillable=[
        'titulo',
        'descripcion',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    //relacion con persona juridica
    public function persona_juridica(){
        return $this->hasMany(Juridica::class, 'id_tipo_empresa', 'id');
    }
}
