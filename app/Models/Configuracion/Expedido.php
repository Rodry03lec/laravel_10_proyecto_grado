<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona\Natural;

class Expedido extends Model
{
    use HasFactory;
    protected $table = 'nl_expedido';
    protected $fillable=[
        'sigla',
        'descripcion',
    ];
    public $timestamps = false;

    //relacion con nl_persona_natural de uno a muchos
    public function persona_natural_expedido(){
        return $this->hasMany(Natural::class, 'id_expedido', 'id');
    }
}
