<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Admin_usuario extends Controller
{
    /**
     * @version 1.0
     * @author Noemi Liz Solares Chico<nlizsolares@gmail.com>
     * @param Controlador Administracion de los usuarios, roles y permisos
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */

    //para crear las gestiones si no existe
    public function __construct() {
        //primero verificamos que año estamos
        $gestion_actual = date('Y');
        //ahora verificamos si existe en la BD
        $verificar_gestion = Gestion::where('gestion', $gestion_actual)->get();
        if (!$verificar_gestion->isNotEmpty()) {
            $crear_gestion = new Gestion;
            $crear_gestion->gestion = $gestion_actual;
            $crear_gestion->estado = 'activo';
            $crear_gestion->save();
        }
    }

    //ADMINISTRACION DE PERFIL
    public function perfil(){
        $data['menu'] = '';
        return view('perfil',$data);
    }
    //para guardar el perfil
    public function guardar_perfil(Request $request){
        $validar = Validator::make($request->all(),[
            'email'    => 'required',
            'celular'  => 'required'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario = User::find($request->id);
            $usuario->email =  $request->email;
            $usuario->celular = $request->celular;
            $usuario->save();
            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se guardo los datos con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para guardar el password
    public function guardar_password(Request $request){
        $validar = Validator::make($request->all(),[
            'password'              => 'required',
            'confirmar_password'    => 'required|min:5|same:password'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario = User::find($request->id);
            $usuario->password =  $request->password;
            $usuario->save();
            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se cambio la contraseña nueva con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //FIN DE LA PARTE DE ADMINISTRACION DE PERFIL

    /**
     * PARA LA PARTE DE LOS USUARIOS
     * */
    public function usuarios(){
        $data['menu'] = 1;
        $data['rol'] = Role::get();
        $data['usuarios'] = User::orderBy('id','desc')->get();
        return view('administrador.sistemas.admin_usuario.usuario',$data);
    }
    //para guardar el usuario
    public function usuario_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'ci'                 => 'required',
            'nombres'            => 'required',
            'apellido_paterno'   => 'required',
            'apellido_materno'   => 'required',
            'rol'                => 'required',
            'usuario'            => 'required',
            'password_'           => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario                    = new User;
            $usuario->ci                =  $request->ci;
            $usuario->nombres           =  $request->nombres;
            $usuario->apellido_paterno  =  $request->apellido_paterno;
            $usuario->apellido_materno  =  $request->apellido_materno;
            $usuario->usuario           =  $request->usuario;
            $usuario->estado            =  'activo';
            $usuario->password          =  Hash::make($request->password_);
            $usuario->save();

            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se guardo el usuario con éxito');
                $usuario->assignRole($request->rol);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para validar CI
    public function usuario_validar(Request $request){
        $ci = $request->ci;
        $usuario = User::where('ci', 'like', $ci)->first();
        if($usuario){
            $data = mensaje_mostrar('success', 'Existe');
        }else{
            $data = mensaje_mostrar('error', 'No existe');
        }
        return response()->json($data);
    }
    //para cambiar el estado
    function usuario_estado(Request $request){
        $usuario = User::find($request->id);
        if($usuario->estado==='activo'){
            $usuario->estado = 'inactivo';
        }else{
            $usuario->estado = 'activo';
        }
        $usuario->save();
        if($usuario->id){
            $data = mensaje_mostrar('success', 'Se cambio el estado con éxito');
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al cambiar el estado');
        }
        return response()->json($data);
    }
    //para eliminar el usuario
    function usuario_eliminar(Request $request){
        $usuario = User::find($request->id);
        if($usuario->delete()){
            $data = mensaje_mostrar('success', 'Se eliminó el usuario con éxito');
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al eliminar el usuario');
        }
        return response()->json($data);
    }
    //para reset usuario y contraseña
    function usuario_reset(Request $request){
        $usuario = User::find($request->id);
        $usuario->load('roles');
        if($usuario->id){
            $data = mensaje_mostrar('success', $usuario);
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al mostrar el usuario');
        }
        return response()->json($data);
    }
    //para guardar el usuario reset o no
    function usuario_reset_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'usuario__'     => 'required',
            'password___'   => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario            = User::find($request->id_reset);
            $usuario->usuario   = $request->usuario__;
            $usuario->password  = Hash::make($request->password___);
            $usuario->save();
            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se realizo el reset de usuario y contraseña');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al realizar el reset de usuario y contraseña');
            }
            return response()->json($data);
        }
        return response()->json($data);

    }
    //para editar y guardar lo editado
    public function usuario_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombres_'            => 'required',
            'apellido_paterno_'   => 'required',
            'apellido_materno_'   => 'required',
            'rol_'                => 'required',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $usuario                    = User::find($request->id_usuario);
            $usuario->nombres           =  $request->nombres_;
            $usuario->apellido_paterno  =  $request->apellido_paterno_;
            $usuario->apellido_materno  =  $request->apellido_materno_;
            $usuario->save();

            if($usuario->id){
                $data = mensaje_mostrar('success', 'Se editó el usuario con éxito');
                $usuario->assignRole($request->rol_);
            }else{
                $data = mensaje_mostrar('error', 'Ocurrio un error al editar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE LOS USUARIOS
     */

    /**
     * PARA LA PARTE DE LOS ROLES
     * */
    public function roles(){
        $data['menu'] = 2;
        $data['roles'] = Role::orderBy('id', 'desc')->get();
        $data['permisos']=Permission::all();
        return view('administrador.sistemas.admin_usuario.roles',$data);
    }
    //para guardar el rol
    public function rol_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_rol' => 'required|unique:roles,name',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $rol        = new Role;
            $rol->name  = $request->nombre_rol;
            $rol->save();
            $rol->syncPermissions($request->permisos);
            if($rol->id){
                $data = mensaje_mostrar('success', 'Se guardo el rol con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para eliminar el rol
    public function rol_eliminar(Request $request){
        $rol = Role::find($request->id);
        if($rol->delete()){
            $data = mensaje_mostrar('success', 'Se elimino con éxito');
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    //para edlitar el rol
    public function rol_editar(Request $request){
        $data['id']=$request->id;
        $rol = Role::find($request->id);
        $data['roles_edi']= $rol;
        $data['permiso'] = Permission::all()->pluck('name', 'id');
        $rol->load('permissions');
        return view('administrador.sistemas.admin_usuario.roles_editar',$data);
    }
    //para guardar lo editado
    public function rol_editar_guardar(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_rol_' => 'required|unique:roles,name,'.$request->id,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $rol        = Role::find($request->id);
            $rol->name  = $request->nombre_rol_;
            $rol->save();
            $rol->syncPermissions($request->permisos);
            if($rol->id){
                $data = mensaje_mostrar('success', 'Se editó el rol con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al editar ');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE LOS ROLES
     */

    /**
     * PARA LA PARTE DE LOS PERMISOS
     * */
    public function permisos(){
        $data['menu'] = 3;
        $data['permiso'] = Permission::get();
        return view('administrador.sistemas.admin_usuario.permisos',$data);
    }
    public function permiso_nuevo(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_permiso' => 'required|unique:permissions,name',
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $permiso        =   new Permission;
            $permiso->name  =   $request->nombre_permiso;
            $permiso->save();
            if($permiso->id){
                $data = mensaje_mostrar('success', 'Se guardo el permiso con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    //para listar el permiso
    public function permiso_listar(){
        $permiso = Permission::OrderBy('id','desc')->get();
        return response()->json($permiso);
    }
    //para eliminar el permiso
    public function permiso_eliminar(Request $request){
        $permiso = Permission::find($request->id);
        if($permiso->delete()){
            $data = mensaje_mostrar('success', 'Se elimino con éxito');
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al eliminar');
        }
        return response()->json($data);
    }
    //para eliminar el permiso
    public function permiso_editar(Request $request){
        $permiso = Permission::find($request->id);
        if($permiso->id){
            $data = mensaje_mostrar('success', $permiso);
        }else{
            $data = mensaje_mostrar('error','Ocurrio un error al editar');
        }
        return response()->json($data);
    }
    //para guardar el permiso editado
    public function permiso_editado(Request $request){
        $validar = Validator::make($request->all(),[
            'nombre_permiso_' => 'required|unique:permissions,name,'.$request->id,
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('errores', $validar->errors());
        }else{
            $permiso        =   Permission::find($request->id);
            $permiso->name  =   $request->nombre_permiso_;
            $permiso->save();
            if($permiso->id){
                $data = mensaje_mostrar('success', 'Se editó el permiso con éxito');
            }else{
                $data = mensaje_mostrar('error','Ocurrio un error al guardar');
            }
        }
        return response()->json($data);
    }
    /**
     * FIN DE LA PARTE DE LOS PERMISOS
     */
}
