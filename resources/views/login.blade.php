<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>LOGIN</title>
    <link rel="icon" type="image/png" href="{{ asset('logos/logogamch.png') }}">
    <link rel="stylesheet" href="{{ asset('admin_template/css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('estilo/estilo_capcha.css') }}">


    <style>
        #error_estilo{
            color:red;
            text-align: center;
            font-size: 14px;
        }
        #success_estilo{
            color:rgb(0, 177, 24);
            text-align: center;
            font-size: 14px;
        }

        #estilo_imagen_f{
            background-color: rgba(0, 0, 0, 0.795) !important;
            background-image: url(imagenes/fondo1_chulumani.jpg);
        }
    </style>
</head>

<body class=" font-inter skin-default">
    <div class="loginwrapper">
        <div class="lg-inner-column">
            <div class="right-column relative">
                <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                    <div class="auth-box h-full flex flex-col justify-center">
                        <div class="mobile-logo text-center mb-6 block flex flex-col justify-center items-center">
                            <img src="{{ asset('logos/logogamch.png') }}" style="max-width: 100%;" width="40%"  alt="" class="mb-10 dark_logo ">
                        </div>
                        <div class="text-center 2xl:mb-10 mb-4">
                            <h4 class="font-medium">LOGIN</h4>
                        </div>
                        <!-- BEGIN: Registration Form -->
                        <form class="space-y-4" id="form_login" method="POST" autocomplete="off">
                            @csrf
                            <div id="mensaje_error"></div>
                                <div class="fromGroup">
                                    <label class="block capitalize form-label">usuario</label>
                                    <div class="relative">
                                        <input type="text" name="usuario" id="usuario" class="form-control py-2" placeholder="Ingrese su usuario">
                                    </div>
                                </div>
                                <div class="fromGroup">
                                    <label class="block capitalize form-label">contraseña</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" class="form-control py-2" placeholder="Ingrese su contraseña">
                                    </div>
                                </div>

                                <div class="fromGroup" >
                                    <div class="captcha">
                                        <div class="captcha-container">
                                            <div class="rectangulo"></div>
                                            <span class="captcha-text" id="optener_cap"></span>
                                        </div>
                                        <button class="action-btn btn-refrescar" onclick="inicio()" type="button">
                                            <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="fromGroup">
                                    <label class="block capitalize form-label">Captcha</label>
                                    <div class="relative">
                                        <input type="text" name="captcha" id="captcha" class="form-control py-2" placeholder="Ingrese capcha">
                                    </div>
                                </div>

                        </form>
                        <div class="py-3">
                            <button class="btn btn-dark block w-full text-center" id="btn_ingresar">INGRESAR</button>
                        </div>

                    </div>
                    <div class="auth-footer text-center">
                        Nliz All Rights Reserved.
                    </div>
                </div>
            </div>
            <div class="left-column bg-cover bg-no-repeat bg-center bg-opacity-80" id="estilo_imagen_f">
                <div class="flex flex-col h-full justify-center">
                    <div class="flex-1 flex flex-col justify-center items-center">
                        <img src="{{ asset('logos/tososomos.png') }}" alt="" style="background-color: rgba(255, 255, 255, 0.226) !important;" class="mb-10 filter brightness-150">
                    </div>
                    <div>
                        <div class="black-500-title max-w-[525px] mx-auto pb-20 text-center">
                            ꧁•N<span class="text-white font-bold"> LIZ•꧂</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
<script>
    let boton_ingresar = document.getElementById('btn_ingresar');
    boton_ingresar.addEventListener('click', async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('form_login')).entries());
        try {
            let respuesta = await fetch("{{ route('ingresar') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'aplication/json'
                },
                body:JSON.stringify(datos)
            });
            let data = await respuesta.json();
            if(data.tipo==='success'){
                document.getElementById('mensaje_error').innerHTML = `<p id="success_estilo" >`+data.mensaje+`</p>`;
                window.location = '';
            }
            if(data.tipo==='error'){
                document.getElementById('mensaje_error').innerHTML = `<p id="error_estilo" >`+data.mensaje+`</p>`;
            }
        } catch (error) {
            console.log('Existe un error: '+error);
        }
    });

    function inicio() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = xhr.responseText;
                document.getElementById('optener_cap').innerHTML = data;
                //document.getElementById('captcha_validar').value = data;
            }
        };
        xhr.open("GET", "{{ route('captcha') }}", true);
        xhr.send();
    }

    document.addEventListener("DOMContentLoaded", inicio);
</script>
