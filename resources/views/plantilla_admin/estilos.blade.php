<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<link rel="icon" type="image/png" href="{{ asset('logos/logogamch.png') }}">
<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset('admin_template/css/rt-plugins.css') }}">
<link rel="stylesheet" href="{{ asset('admin_template/css/app.css') }}">
<!-- End : Theme CSS -->
<link rel="stylesheet" href="{{ asset('admin_template/css/loader.css') }}">

<!-- Start : theme-store js -->
<script src="{{ asset('admin_template/js/store.js') }}" sync></script>
<!-- End : theme-store js -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('admin_template/js_nece/dataTables.css') }}" rel="stylesheet">

<style>
    /* Para que el modal aparezca en el lado derecho */
    .modal.modal-izquierda .modal-dialog {
        /*right: 0;*/
        margin-left: 0.5%;
        margin-top: 0.5%;
    }
    fieldset {
        border: 2px solid #030303;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }

    /* Estilos para la leyenda */
    legend {
        font-weight: bold;
        color: #333;
        font-size: 1.2em;
        padding: 10px;
    }
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
</style>
