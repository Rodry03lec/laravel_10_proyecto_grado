<?php

namespace App\Models\Caja;

use App\Models\Gestion;
use App\Models\Mes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caja\Registro_cobros;
use App\Models\Caja\Caja_detalle;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;


class Facturacion extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nl_facturacion';
    protected $fillable=[
        'numero_factura',
        'id_gestion',
        'id_mes',
        'fecha',
        'id_registro_cobro',
        'id_usuario',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';


    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'numero_factura',
                'gestion',
                'mes',
                'fecha',
                'registro_cobros',
                'id_usuario',
            ])
            ->useLogName('nl_facturacion')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }

    //relacion reversa nl_gestion
    public function gestion() {
        return $this->belongsTo(Gestion::class, 'id_gestion', 'id');
    }
    //relacion reversa de nl_mes
    public function mes() {
        return $this->belongsTo(Mes::class, 'id_mes', 'id');
    }
    //relacion reversa de nl_registro_cobros
    public function registro_cobros() {
        return $this->belongsTo(Registro_cobros::class, 'id_registro_cobro', 'id');
    }
    //relacion con con nl_caja_detalle
    public function caja_detalle(){
        return $this->hasOne(Caja_detalle::class, 'id_factura', 'id');
    }
}
