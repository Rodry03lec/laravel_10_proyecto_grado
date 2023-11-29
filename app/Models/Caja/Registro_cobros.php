<?php

namespace App\Models\Caja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caja\Facturacion;
use App\Models\Servicio\Instalacion;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Registro_cobros extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nl_registro_cobros';
    protected $fillable=[
        'numero_mes',
        'fecha',
        'descripcion',
        'estado',
        'id_instalacion',
        'estado',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'numero_mes',
                'fecha',
                'descripcion',
                'estado',
                'instalacion',
                'estado',
            ])
            ->useLogName('nl_registro_cobros')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }

    //relacion con caturacion
    public function facturacion(){
        return $this->hasMany(Facturacion::class, 'id_registro_cobro', 'id');
    }
    //relacion reversa nl_instalacion
    public function instalacion(){
        return $this->belongsTo(Instalacion::class, 'id_instalacion', 'id');
    }
}
