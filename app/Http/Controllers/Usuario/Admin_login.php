<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class Admin_login extends Controller
{

    /**
     * @version 1.0
     * @author Rodrigo Lecoña Quispe <rodrigolecona97@gmail.com>
     * @param Controlador para el ingreso para usuarios registrados
     * ¡Muchas gracias por preferirnos! Esperamos poder servirte nuevamente
     */
    //para ingresar usuario y contraseña
    public function ingresar(Request $request){
        $mensaje = "Usuario y contraseña invalidos";
        $validar = Validator::make($request->all(),[
            'usuario'=>'required',
            'password'=>'required'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('error', 'Todos los campos son requeridos');
        }else{
            //comprobamos si el usuario existe o si esta activo
            $usuario = User::where('usuario', $request->usuario)->get();
            if(!$usuario->isEmpty()){
                $compara = Auth::attempt([
                    'usuario'    => $request->usuario,
                    'password'   => $request->password,
                    'estado'     => 'activo',
                    'deleted_at' => NULL
                ]);
                if($compara){
                    $data = mensaje_mostrar('success', 'Inicio de session con éxito');
                    $request->session()->regenerate();
                }else{
                    $data = mensaje_mostrar('error', $mensaje);
                }
            }else{
                $data = mensaje_mostrar('error', $mensaje);
            }
        }
        return response()->json($data);
    }

    //para ingresar al inicio
    public function inicio(){
        $data['menu'] = 0;
        return view('menu.inicio', $data);
    }
    //para ingresar al sistema
    public function sistemas(){
        $data['menu'] = '0';
        return view('administrador.sistemas.inicio_sistemas', $data);
    }
    //para ingresar a recaudaciones
    public function recaudaciones(){
        $data['menu'] = '0';
        return view('administrador.recaudaciones.inicio_recaudaciones', $data);
    }
    //para ingresar a caja
    public function caja(){
        $data['menu'] = '0';
        return view('menu.principal_caja', $data);
    }

    /**
     * CERRAR LA SESSION
     */
    public function cerrar_session(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $data = mensaje_mostrar('success', 'Finalizo la session con éxito!');
        return response()->json($data);
    }
    /**
     * FIN DE CERRAR LA SESSION
     */
}
