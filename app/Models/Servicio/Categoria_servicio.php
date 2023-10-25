<?php

namespace App\Models\Servicio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_servicio extends Model
{
    use HasFactory;
    protected $table = 'nl_categoria';
    protected $fillable=[
        'nombre',
        'precio_fijo',
        'id_gestion'
    ];
}
