<?php

namespace App\Models\Personal;

use App\Models\Persona\Natural;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal\Cargo;
use App\Models\Servicio\Instalacion;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Personal_trabajo extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nl_personal_trabajo';
    protected $fillable=[
        'fecha_contratacion',
        'fecha_finalizacion',
        'estado',
        'referencia_laboral',
        'referencia_nombre',
        'descripcion',
        'id_persona',
        'id_cargo',
        'id_usuario'
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'fecha_contratacion',
                'fecha_finalizacion',
                'estado',
                'referencia_laboral',
                'referencia_nombre',
                'descripcion',
                'persona_natural',
                'cargo',
                'id_usuario'
            ])
            ->useLogName('nl_personal_trabajo')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }

    //relacion reversa de nl_cargo
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'id_cargo', 'id');
    }
    //relacion reversa con la persona natural
    public function persona_natural(){
        return $this->belongsTo(Natural::class, 'id_persona', 'id');
    }

    //relacion con nl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_personal_trabajo', 'id');
    }
}
