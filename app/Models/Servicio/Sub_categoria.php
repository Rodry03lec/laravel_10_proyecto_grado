<?php

namespace App\Models\Servicio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio\Categoria_servicio;

class Sub_categoria extends Model
{
    use HasFactory;
    protected $table = 'nl_sub_categoria';
    protected $fillable=[
        'nombre',
        'precio_fijo',
        'descripcion',
        'id_categoria',
    ];
    //relacion reversa de cateogira servicios
    public function categoria(){
        return $this->belongsTo(Categoria_servicio::class, 'id_categoria', 'id');
    }
}
