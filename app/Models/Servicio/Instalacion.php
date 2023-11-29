<?php

namespace App\Models\Servicio;

use App\Models\Caja\Caja_detalle;
use App\Models\Caja\Registro_cobros;
use App\Models\Configuracion\Tipo_propiedad;
use App\Models\Configuracion\Zonas;
use App\Models\Persona\Juridica;
use App\Models\Persona\Natural;
use App\Models\Personal\Personal_trabajo;
use App\Models\Servicio\Sub_categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\Servicio\Historial_instalacion;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Instalacion extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nl_instalacion';
    protected $fillable=[
        'direccion',
        'fecha_instalacion',
        'fecha_conclucion',
        'estado_instalacion',
        'corte',
        'monto_instalacion',
        'glosa',
        'id_zona',
        'id_persona',
        'id_persona_natural',
        'id_persona_juridica',
        'id_sub_categoria',
        'id_propiedad',
        'id_personal_trabajo',
        'id_usuario'
    ];

    const CREATED_AT = 'creado_el';
    const UPDATED_AT = 'editado_el';

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'direccion',
                'fecha_instalacion',
                'fecha_conclucion',
                'estado_instalacion',
                'corte',
                'monto_instalacion',
                'glosa',
                'zona',
                'id_persona',
                'persona_natural',
                'persona_juridica',
                'sub_categoria',
                'tipo_propiedad',
                'personal_trabajo',
                'id_usuario'
            ])
            ->useLogName('nl_instalacion')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }



    protected function montoinstalacion():Attribute{
        return new Attribute(
            get: fn ($value) => con_separador_comas($value),
        );
    }


    //relacion reversa on nl_zonas
    public function zona(){
        return $this->belongsTo(Zonas::class, 'id_zona', 'id');
    }

    //relacion reversa con nl_persona_natural
    public function persona_natural(){
        return $this->belongsTo(Natural::class, 'id_persona_natural', 'id');
    }

    //relacion reversa con nl_persona_juridica
    public function persona_juridica(){
        return $this->belongsTo(Juridica::class, 'id_persona_juridica', 'id');
    }

    //relacion reversa con nl_categoria
    public function sub_categoria(){
        return $this->belongsTo(Sub_categoria::class, 'id_sub_categoria', 'id');
    }

    //relacion reversa con nl_tipo_propiedad
    public function tipo_propiedad(){
        return $this->belongsTo(Tipo_propiedad::class, 'id_propiedad', 'id');
    }

    //relacion de uno a muchos con la parte de la instalacion
    public function historial_instalacion(){
        return $this->hasMany(Historial_instalacion::class, 'id_instalacion', 'id');
    }

    //relacion con la parte de instalacion
    public function caja_detalle(){
        return $this->hasMany(Caja_detalle::class, 'id_instalacion', 'id');
    }

    //relacion de uno a uno con nl_registro_cobros
    public function registro_cobros(){
        return $this->hasOne(Registro_cobros::class, 'id_instalacion', 'id');
    }

    //relacion reversa con nl_personal trabajo
    public function personal_trabajo(){
        return $this->belongsTo(Personal_trabajo::class, 'id_personal_trabajo', 'id');
    }
}
