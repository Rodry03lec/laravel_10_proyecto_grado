<?php

namespace App\Models\Personal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\Unidad;
use App\Models\Personal\Personal_trabajo;

/* use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth; */

class Cargo extends Model
{
    use HasFactory/* , LogsActivity */;
    protected $table = 'nl_cargo';
    protected $fillable=[
        'nombre',
        'descripcion',
        'id_unidad'
    ];

    /* public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'nombre',
                'descripcion',
                'unidad'
            ])
            ->useLogName('nl_cargo')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    } */

    //relacion reversa con unidad
    public function unidad(){
        return $this->belongsTo(Unidad::class, 'id_unidad', 'id');
    }

    //relacion con el personal de trabajo
    public function personal_trabajo(){
        return $this->hasMany(Personal_trabajo::class, 'id_cargo', 'id');
    }
}
