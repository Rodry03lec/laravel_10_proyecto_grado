<?php

namespace App\Models\Persona;

use App\Models\Configuracion\Tipo_empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona\Natural;
use App\Models\Servicio\Instalacion;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Juridica extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'nl_persona_juridica';
    protected $fillable=[
        'nombre_empresa',
        'email',
        'telefono',
        'celular',
        'nit',
        'fecha_constitucion',
        'actividad_economica',
        'numero_testimonio',
        'testimonio',
        'id_representante_legal',
        'id_asesor',
        'id_tipo_empresa',
        'id_usuario',
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';


    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'nombre_empresa',
                'email',
                'telefono',
                'celular',
                'nit',
                'fecha_constitucion',
                'actividad_economica',
                'numero_testimonio',
                'testimonio',
                'representante_legal',
                'asesor',
                'tipo_empresa',
                'id_usuario',
            ])
            ->useLogName('nl_persona_juridica')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }

    //relacion reversa de tipo de empresa
    public function tipo_empresa(){
        return $this->belongsTo(Tipo_empresa::class, 'id_tipo_empresa', 'id');
    }

    //relacion reversa de persona natural representante legal
    public function representante_legal(){
        return $this->belongsTo(Natural::class, 'id_representante_legal', 'id');
    }
    //relacion reversa de persona natural asesor
    public function asesor(){
        return $this->belongsTo(Natural::class, 'id_asesor', 'id');
    }
    //relacion con nl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_persona_juridica', 'id');
    }
}
