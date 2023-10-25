<?php

namespace App\Models\Configuracion;

use App\Models\Persona\Natural;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;
    protected $table = 'nl_profesion';
    protected $fillable=[
        'descripcion',
    ];
    public $timestamps = false;

    //relacion de muchos a muchos con persona natural
    public function persona_natural(){
        return $this->belongsToMany(Natural::class, 'natural_profesion', 'id_profesion', 'id_persona_natural');
    }
}
