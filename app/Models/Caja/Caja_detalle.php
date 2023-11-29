<?php

namespace App\Models\Caja;

use App\Models\Servicio\Instalacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Caja_detalle extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nl_caja_detalle';
    protected $fillable=[
        'fecha',
        'concepto',
        'moneda',
        'monto_ingreso',
        'monto_salida',
        'importe',
        'estado',
        'id_usuario',
        'id_instalacion',
        'id_factura',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';


    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'fecha',
                'concepto',
                'moneda',
                'monto_ingreso',
                'monto_salida',
                'importe',
                'estado',
                'id_usuario',
                'instalacion',
                'id_factura',
            ])
            ->useLogName('nl_caja_detalle')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }

    //relacion reversa con nl_instalacion
    public function instalacion(){
        return $this->belongsTo(Instalacion::class, 'id_instalacion', 'id');
    }
}
