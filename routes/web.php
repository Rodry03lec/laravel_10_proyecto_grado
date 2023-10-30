<?php

use App\Http\Controllers\Configuracion\Controlador_configuracion;
use App\Http\Controllers\Configuracion\Controlador_gestion;
use App\Http\Controllers\Configuracion\Controlador_zona;
use App\Http\Controllers\Persona\Controlador_persona;
use App\Http\Controllers\Servicio\Controlador_instalacion;
use App\Http\Controllers\Usuario\Admin_login;
use App\Http\Controllers\Usuario\Admin_usuario;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->middleware(['no_autenticados'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('ingresar',[Admin_login::class, 'ingresar'])->name('ingresar');
});


Route::prefix('/admin')->middleware(['autenticados'])->group(function(){
    Route::controller(Admin_login::class)->group(function(){
        Route::get('inicio','inicio')->name('inicio');
        Route::get('sistemas','sistemas')->name('sistemas');
        Route::get('recaudaciones','recaudaciones')->name('recaudaciones');
        Route::get('caja','caja')->name('caja');
        Route::post('salir','cerrar_session')->name('salir');
    });

    /**
     * ADMINISTRACION DE USUARIOS
     */
    Route::controller(Admin_usuario::class)->group(function(){
        Route::get('sys/perfil','perfil')->name('perfil');
        Route::post('sys/guardar_perfil','guardar_perfil')->name('guardar_perfil');
        Route::post('sys/guardar_password','guardar_password')->name('guardar_password');
        //USUARIOS
        Route::get('sys/usuarios','usuarios')->name('usuarios');
        Route::post('sys/usuario_guardar','usuario_guardar')->name('usuario_guardar');
        Route::post('sys/usuario_validar','usuario_validar')->name('usuario_validar');
        Route::post('sys/usuario_listar','usuario_listar')->name('usuario_listar');
        Route::post('sys/usuario_estado','usuario_estado')->name('usuario_estado');
        Route::delete('sys/usuario_eliminar','usuario_eliminar')->name('usuario_eliminar');
        Route::post('sys/usuario_reset','usuario_reset')->name('usuario_reset');
        Route::post('sys/usuario_reset_guardar','usuario_reset_guardar')->name('usuario_reset_guardar');
        Route::post('sys/usuario_editar_guardar','usuario_editar_guardar')->name('usuario_editar_guardar');
        //ROLES
        Route::get('sys/roles','roles')->name('roles');
        Route::post('sys/rol_nuevo','rol_nuevo')->name('rol_nuevo');
        Route::delete('sys/rol_eliminar','rol_eliminar')->name('rol_eliminar');
        Route::post('sys/rol_editar','rol_editar')->name('rol_editar');
        Route::post('sys/rol_editar_guardar','rol_editar_guardar')->name('rol_editar_guardar');
        //PERMISOS
        Route::get('sys/permisos','permisos')->name('permisos');
        Route::post('sys/permiso_nuevo','permiso_nuevo')->name('permiso_nuevo');
        Route::get('sys/permiso_listar','permiso_listar')->name('permiso_listar');
        Route::post('sys/permiso_eliminar','permiso_eliminar')->name('permiso_eliminar');
        Route::post('sys/permiso_editar','permiso_editar')->name('permiso_editar');
        Route::post('sys/permiso_editado','permiso_editado')->name('permiso_editado');
    });
    /**
     * FIN DE ADMINISTRACION DE USUARIOS
     **/

    /**
     * PARA LA ADMINISTRACION DE GESTIONES
    */
    Route::controller(Controlador_gestion::class)->group(function(){
        Route::get('gestion','gestion')->name('gestion');
        Route::post('gestion_crear','gestion_crear')->name('gestion_crear');
        Route::post('gestion_editar','gestion_editar')->name('gestion_editar');
        Route::post('gestion_editar_guardar','gestion_editar_guardar')->name('gestion_editar_guardar');
        Route::delete('gestion_eliminar','gestion_eliminar')->name('gestion_eliminar');

        //para la parte de la categoria
        Route::post('categoria_guardar','categoria_guardar')->name('categoria_guardar');
        Route::post('categoria_listar','categoria_listar')->name('categoria_listar');
        Route::post('categoria_editar','categoria_editar')->name('categoria_editar');
        Route::delete('categoria_eliminar','categoria_eliminar')->name('categoria_eliminar');
    });
    /**
     * * FIN PARA LA ADMINISTRACION DE GESTIONES
    */

    /**
     * PARA LA PARTE DE LAS ZONAS
     */
    Route::controller(Controlador_zona::class)->group(function(){
        //para crear el tipo de zona
        Route::get('tipo_zona','tipo_zona')->name('tzn_index');
        Route::post('tipo_zona_nuevo','tipo_zona_nuevo')->name('tzn_crear');
        Route::post('tipo_zona_listar','tipo_zona_listar')->name('tzn_listar');
        Route::delete('tipo_zona_eliminar','tipo_zona_eliminar')->name('tzn_eliminar');
        Route::post('tipo_zona_editar','tipo_zona_editar')->name('tzn_editar');
        Route::post('tipo_zona_editar_guardar','tipo_zona_editar_guardar')->name('tzn_guardar_edi');

        //para la parte de las zonas
        Route::get('zonas','zonas')->name('zn_index');
        Route::post('zonas_nuevo','zonas_nuevo')->name('zn_crear');
        Route::delete('zonas_eliminar','zonas_eliminar')->name('zn_eliminar');
        Route::post('zonas_editar','zonas_editar')->name('zn_editar');
        Route::post('zonas_editar_guardar','zonas_editar_guardar')->name('zn_editar_gr');
    });
    /**
     *
     * FIN DE LA PARTE DE LAS ZONAS
     */

    /**
     * CONTROLADOR CONFIGURACIÓN
     */
    Route::controller(Controlador_configuracion::class)->group(function (){

        //controlador configuracion
        Route::get('categoria', 'categoria')->name('cat_index');

        //para la parte de profesion
        Route::get('profesion','profesion')->name('pro_index');
        Route::get('profesion_listar','profesion_listar')->name('pro_listar');
        Route::post('profesion_nuevo','profesion_nuevo')->name('pro_nuevo');
        //para la parte e expedido
        Route::get('expedido','expedido')->name('exp_index');
        Route::post('expedido_listar','expedido_listar')->name('exp_listar');
        Route::post('expedido_nuevo','expedido_nuevo')->name('exp_nuevo');
        //para la parte de tipo de empresa
        Route::get('tipo_empresa','tipo_empresa')->name('tem_index');
        Route::post('tipo_empresa_listar','tipo_empresa_listar')->name('tem_listar');
        Route::post('tipo_empresa_nuevo','tipo_empresa_nuevo')->name('tem_nuevo');
        //para la parte de tipo de propiedad
        Route::get('tipo_propiedad','tipo_propiedad')->name('tpr_index');
        Route::post('tipo_propiedad_listar','tipo_propiedad_listar')->name('tpr_listar');
        Route::post('tipo_propiedad_nuevo','tipo_propiedad_nuevo')->name('tpr_nuevo');
    });
    /**
     * FIN DE CONTROLADOR CONFIGURACION
     */

    /**
     * CONTROLADOR PERSONA
     */
    Route::controller(Controlador_persona::class)->group(function(){
        //par la persona natural
        Route::get('personaNatural','persona_natural')->name('pna_index');
        Route::post('personaNatural_validar','personaNatural_validar')->name('pna_validar');
        Route::post('personaNatural_nuevo','personaNatural_nuevo')->name('pna_nuevo');
        Route::get('personaNatural_listar','personaNatural_listar')->name('pna_listar');
        Route::post('personaNatural_editar','personaNatural_editar')->name('pna_editar');
        Route::post('personaNatural_editar_guardar','personaNatural_editar_guardar')->name('pna_update');
        Route::post('personaNatural_vizualizar','personaNatural_vizualizar')->name('pna_vizualizar');
        Route::delete('personaNatural_eliminar','personaNatural_eliminar')->name('pna_delete');
        //para la persona juridica
        Route::get('personaJuridica','persona_juridica')->name('pju_index');
        Route::post('personaJuridica_validar','persona_juridica_validar')->name('pju_validar');
        Route::post('personaJuridica_nuevo','persona_juridica_nuevo')->name('pju_nuevo');
        Route::get('personaJuridica_listar','persona_juridica_listar')->name('pju_listar');
        Route::delete('personaJuridica_eliminar','persona_juridica_eliminar')->name('pju_delete');
        Route::post('personaJuridica_editar','persona_juridica_editar')->name('pju_editar');
        Route::post('personaJuridica_update','persona_juridica_uptate')->name('pju_update');
    });
    /**
     * FIN DEL CONTROLADOR PERSONA
     */

    /**
     * PARA LA PARTE DEL CONTROLADOR INSTALACIÓN
     */
    Route::controller(Controlador_instalacion::class)->group(function(){
        //para la parte de instalacion
        Route::get('instalacion','instalacion')->name('ins_index');
        Route::post('instalacion_validar_persona','instalacion_validar_persona')->name('ins_validarp');
        Route::post('instalacion_nuevo','instalacion_nuevo')->name('ins_nuevo');
        Route::post('instalacion_categoria_listar','instalacion_categoria_listar')->name('ins_listar_categoria');
        Route::get('instalacion_listar','instalacion_listar')->name('ins_listar');

        //para la gestion
        Route::post('listar_categoria', 'listar_categoria')->name('lisc_listar');
    });
    /**
     * FIN DE LA PARTE DE CONTROLADOR INSTLACION
     */

});
