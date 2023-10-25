<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    use HasFactory;
    protected $table = 'nl_mes';
    protected $fillable=[
        'numero_mes',
        'nombre_mes'
    ];
}
