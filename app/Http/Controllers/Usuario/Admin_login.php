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
        //par arecuperar el cpacha de la session
        $capcha_recuperado = session()->get('captchaText_recuperado');
        //eliminar los estilos
        $captcha_texto = strip_tags($capcha_recuperado);

        $mensaje = "Usuario y contraseña invalidos";
        $validar = Validator::make($request->all(),[
            'usuario'   => 'required',
            'password'  => 'required',
            'captcha'   => 'required'
        ]);
        if($validar->fails()){
            $data = mensaje_mostrar('error', 'Todos los campos son requeridos');
        }else{
            if($request->captcha == $captcha_texto){
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
        return view('administrador.caja.inicio_caja', $data);
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

    //para la parte de captcha
    public function generateCaptchaImage(){
        $length = 7; // Longitud del CAPTCHA
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
        $captchaText = '';
        // Genera el texto CAPTCHA aleatorio
        for ($i = 0; $i < $length; $i++) {
            $captchaText .= $characters[rand(0, strlen($characters) - 1)];
        }
        // Distorsión del texto
        $captchaText = $this->distortText($captchaText);
        session()->put('captchaText_recuperado', $captchaText);
        return $captchaText;
    }

    private function distortText($text) {
        $distortedText = '';
        $maxRotation = 15; // Máxima rotación en grados
        $letterSpacing = -1; // Espaciado entre letras en píxeles

        for ($i = 0; $i < strlen($text); $i++) {
            // Genera un color aleatorio en formato hexadecimal (#RRGGBB)
            $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

            // Calcula una rotación aleatoria entre -maxRotation y maxRotation
            $rotation = rand(-$maxRotation, $maxRotation);

            // Aplica la rotación, el espaciado y el color al carácter actual
            $distortedText .= $this->rotateAndSpaceAndColorCharacter($text[$i], $rotation, $letterSpacing, $randomColor);
        }

        return $distortedText;
    }

    private function rotateAndSpaceAndColorCharacter($char, $rotation, $letterSpacing, $color) {
        // Rotación, espaciado y color de un carácter
        return '<span style="transform: rotate(' . $rotation . 'deg); display: inline-block; margin-right: ' . $letterSpacing . 'px; color: ' . $color . ';">' . $char . '</span>';
    }

}
