<?php

namespace App\Models\Servicio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio\Sub_categoria;

class Categoria_servicio extends Model
{
    use HasFactory;
    protected $table = 'nl_categoria';
    protected $fillable=[
        'nombre'
    ];

    //relacion con subcategoria
    public function sub_categoria(){
        return $this->hasMany(Sub_categoria::class, 'id_categoria', 'id');
    }
}
