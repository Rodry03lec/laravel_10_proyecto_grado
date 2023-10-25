<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuracion\Zonas;
use App\Models\Persona\Natural;

class Tipo_zona extends Model
{
    use HasFactory;
    protected $table = 'nl_tipo_zona';
    protected $fillable=[
        'nombre',
    ];

    //reversa de Zonas
    public function reversa_zonas(){
        return $this->belongsTo(Zonas::class, 'id', 'id_tipo_zona');
    }
    //relacion con persona natural
    public function persona_natural_zonas(){
        return $this->hasMany(Natural::class, 'id_zona', 'id');
    }
}
