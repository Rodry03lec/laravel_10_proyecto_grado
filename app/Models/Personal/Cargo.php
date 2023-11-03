<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\Unidad;
use App\Models\Personal\Personal_trabajo;

class Cargo extends Model
{
    use HasFactory;
    protected $table = 'nl_cargo';
    protected $fillable=[
        'nombre',
        'descripcion',
        'id_unidad'
    ];

    //relacion reversa con unidad
    public function unidad(){
        return $this->belongsTo(Unidad::class, 'id_unidad', 'id');
    }

    //relacion con el personal de trabajo
    public function personal_trabajo(){
        return $this->hasMany(Personal_trabajo::class, 'id_cargo', 'id');
    }
}
