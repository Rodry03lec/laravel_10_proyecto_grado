<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_propiedad extends Model
{
    use HasFactory;
    protected $table = 'nl_tipo_propiedad';
    protected $fillable=[
        'titulo',
        'descripcion',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';


}
