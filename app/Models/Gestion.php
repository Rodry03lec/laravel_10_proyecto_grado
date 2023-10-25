<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;
    protected $table = 'nl_gestion';
    protected $fillable=[
        'gestion',
        'estado'
    ];
}
