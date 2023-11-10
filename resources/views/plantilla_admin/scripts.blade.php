<script src="{{ asset('admin_template/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin_template/js/rt-plugins.js') }}"></script>
<script src="{{ asset('admin_template/js/app.js') }}"></script>
<script src="{{ asset('admin_template/js_nece/sweetalert2.js') }}"></script>


{{-- <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.js"></script> --}}

<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Espera a que la página se cargue completamente
    window.addEventListener('load', function() {
    var loader = document.getElementById('loading-wrapper');
        loader.style.display = 'none';
    });

    //para cerrar la session
    let btn_cerrar_session = document.getElementById("btn-cerrar-session");
    btn_cerrar_session.addEventListener("click", async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('formulario_salir')).entries());
        try {
            let respuesta = await fetch("{{ route('salir') }}",{
                method:"POST",
                headers:{
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(datos)
            });
            let dato = await respuesta.json();
            alerta_top(dato.tipo, dato.mensaje);
            setTimeout(() => {
                window.location = '';
            }, 1500);

        } catch (error) {
            console.log('Ocurrio un error: '+error);
        }
    });

    function alerta_top(tipo, mensaje){
        Swal.fire({
            position: 'top-end',
            icon: tipo,
            title: mensaje,
            showConfirmButton: false,
            timer: 1500
        })
    }

    //PARA GUARDAR LOS DATOS PERSONALES
    let btn_guardar_informacion_personal = document.getElementById('btn_informacion_personal');
    btn_guardar_informacion_personal.addEventListener("click", async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('form_informacion_personal')).entries());
        limpiar_campos('form_informacion_personal');
        vaciar_errores_perfil();
        try {
            let respuesta = await fetch("{{ route('guardar_perfil') }}",{
                method: "POST",
                headers:{
                    'Content-Type':'application/json',
                },
                body: JSON.stringify(datos)
            });
            let dato = await respuesta.json();
            if(dato.tipo==='errores'){
                let obj = dato.mensaje;
                for (let key in obj) {
                    document.getElementById('_'+key).innerHTML = `<p id="error_estilo" >`+obj[key]+`</p>`;
                }
            }
            if(dato.tipo==='success'){
                alerta_top(dato.tipo, dato.mensaje);
                setTimeout(() => {
                    window.location = '';
                }, 1500);
            }
            if(dato.tipo==='error'){
                alerta_top(dato.tipo, dato.mensaje);
            }
        } catch (error) {
            console.log('Ocurrio un error: '+error);
        }
    });
    //para guardar el usuario y contraseña
    let btn_password_guardar = document.getElementById('btn_password');
    btn_password_guardar.addEventListener("click", async ()=>{
        let datos = Object.fromEntries(new FormData(document.getElementById('form_password')).entries());
        limpiar_campos('form_password');
        vaciar_errores_perfil();
        try {
            let respuesta = await fetch("{{ route('guardar_password') }}",{
                method: "POST",
                headers:{
                    'Content-Type':'application/json',
                },
                body: JSON.stringify(datos)
            });
            let dato = await respuesta.json();
            if(dato.tipo==='errores'){
                let obj = dato.mensaje;
                for (let key in obj) {
                    document.getElementById('_'+key).innerHTML = `<p id="error_estilo" >`+obj[key]+`</p>`;
                }
            }
            if(dato.tipo==='success'){
                alerta_top(dato.tipo, dato.mensaje);
                limpiar_campos('form_password');
                setTimeout( async () => {
                    let datos = Object.fromEntries(new FormData(document.getElementById('formulario_salir')).entries());
                    try {
                        let respuesta = await fetch("{{ route('salir') }}",{
                            method:"POST",
                            headers:{
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(datos)
                        });
                        let dato = await respuesta.json();
                        alerta_top(dato.tipo, 'vuelva a iniciar la session con la nueva contraseña');
                        setTimeout(() => {
                            window.location = '';
                        }, 1500);

                    } catch (error) {
                        console.log('Ocurrio un error: '+error);
                    }
                }, 1500);
            }
            if(dato.tipo==='error'){
                alerta_top(dato.tipo, dato.mensaje);
            }
        } catch (error) {
            console.log('Ocurrio un error: '+error);
        }
    });

    function cerrar_modal_perfil(){
        vaciar_errores_perfil();
        limpiar_campos('form_informacion_personal');
        limpiar_campos('form_password');
    }


    function vaciar_errores_perfil(){
        document.getElementById('_email').innerHTML           =   '';
        document.getElementById('_celular').innerHTML           =   '';

        document.getElementById('_password').innerHTML           =   '';
        document.getElementById('_confirmar_password').innerHTML =   '';
    }


    //para reset de formulario
    function limpiar_campos(form_id){
        document.getElementById(form_id).reset();
    }

    //para que no funcione el enter
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
            if(e.keyCode == 13) {
                e.preventDefault();
            }
        }))
    });



    // Obtén todos los elementos con la clase "monto_number"
    var elementos = document.querySelectorAll(".monto_number");

    // Agrega eventos "focus" y "keyup" a cada elemento
    elementos.forEach(function(elemento) {
        elemento.addEventListener("focus", function(event) {
            event.target.select();
        });

        elemento.addEventListener("keyup", function(event) {
            event.target.value = event.target.value
                .replace(/\D/g, "")
                .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
    });


    //para que solo acepte letras  <input type="text" onkeypress="return soloLetras(event)">
    function soloLetras(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";
        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    //para que solo acepte numeros <input type="text" onkeypress="return soloNumeros(event)">
    function soloNumeros(e){
        let key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key==8))
    }
    //para que solo acepte numeros float <input type="text" onkeypress="return filterFloat(event, this)">
    function filterFloat(evt,input){
        // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempValue = input.value+chark;
            if(key >= 48 && key <= 57){
                if(filter(tempValue)=== false){
                    return false;
                }else{
                    return true;
                }
            }else{
                if(key == 8 || key == 13 || key == 0) {
                    return true;
                }else if(key == 46){
                        if(filter(tempValue)=== false){
                            return false;
                        }else{
                            return true;
                        }
                }else{
                    return false;
                }
            }
        }
    function filter(__val__){
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if(preg.test(__val__) === true){
            return true;
        }else{
        return false;
        }

    }


    function conSeparadorComas(monto) {
        let saldoRespuesta = new Intl.NumberFormat('es-BO', { style: 'currency', currency: 'BOB' }).format(monto);
        return saldoRespuesta;
    }


    function select2_prueva(valor){
        $('.select2').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }
    function select2_uno(valor){
        $('.select2_uno').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }

    function select2_dos(valor){
        $('.select2_dos').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }
    function select2_tres(valor){
        $('.select2_tres').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }

    function select2_cuatro(valor){
        $('.select2_cuarto').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }

    function select2_5(valor){
        $('.select2_5').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }
    function select2_6(valor){
        $('.select2_6').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }
    function select2_7(valor){
        $('.select2_7').select2({
            dropdownParent: $(valor),
            containerCssClass: "p-1 bg-gray-100",
            selectionCssClass: "p-1 bg-blue-500 text-white",
            dropdownCssClass: "p-1 bg-gray-300",
        });
    }

</script>
