<?php

namespace App\Models\Personal;

use App\Models\Persona\Natural;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\Cargo;

class Personal_trabajo extends Model
{
    use HasFactory;
    protected $table = 'nl_personal_trabajo';
    protected $fillable=[
        'fecha_contratacion',
        'fecha_finalizacion',
        'estado',
        'referencia_laboral',
        'descripcion',
        'id_persona',
        'id_cargo'
    ];

    //relacion reversa de nl_cargo
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id');
    }
    //relacion reversa con la persona natural
    public function persona_natural(){
        return $this->belongsTo(Natural::class, 'id_persona', 'id');
    }
}
