<?php

namespace App\Models\Servicio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio\Categoria_servicio;
use App\Models\Servicio\Instalacion;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;

class Sub_categoria extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'nl_sub_categoria';
    protected $fillable=[
        'nombre',
        'precio_fijo',
        'descripcion',
        'id_categoria',
    ];

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
            ->logOnly([
                'nombre',
                'precio_fijo',
                'descripcion',
                'categoria',
            ])
            ->useLogName('nl_sub_categoria')  //aqui podemos cambiar el nombre dependiendo al modelo
            ->setDescriptionForEvent(function (string $eventName) {
                $user = Auth::user();
                return "Este modelo ha sido {$eventName} por el usuario {$user->nombres} {$user->apellido_paterno} {$user->apellido_materno} (ID: {$user->id})  (CI: {$user->ci})";
            })
            ->logOnlyDirty() // Este método especifica que solo se deben registrar en el log los campos que han cambiado desde la última vez que se guardó el modelo.
            ->dontSubmitEmptyLogs(); //Este método indica al paquete que no debe registrar entradas de log cuando no hay cambios en el modelo.
    }

    //relacion reversa de cateogira servicios
    public function categoria(){
        return $this->belongsTo(Categoria_servicio::class, 'id_categoria', 'id');
    }

    //relacion de unoa a muchjos co nnl_instalacion
    public function instalacion(){
        return $this->hasMany(Instalacion::class, 'id_sub_categoria', 'id');
    }
}
