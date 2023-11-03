<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\Cargo;

class Unidad extends Model
{
    use HasFactory;
    protected $table = 'nl_unidad';
    protected $fillable=[
        'nombre',
        'descripcion',
    ];

    //relacion con nl_unidad
    public function cargo(){
        return $this->hasMany(Cargo::class, 'id_unidad', 'id');
    }
}
