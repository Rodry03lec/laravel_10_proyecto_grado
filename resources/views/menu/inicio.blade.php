<!DOCTYPE html>
<html lang="es" dir="ltr" class="light">

<head>
    <title>ADM | INICIO </title>
    @include('plantilla_admin.estilos')
</head>

<body class="font-inter dashcode-app" id="body_class">

    <!-- Loading wrapper start -->
    <div id="loading-wrapper">
        <div class="spinner-border"></div>
        Cargando inicio .....
    </div>
    <!-- Loading wrapper end -->

    <main class="app-wrapper">
        <!-- BEGIN: Sidebar -->
        {{-- MENU --}}
        <!-- BEGIN: Sidebar -->
        <div class="sidebar-wrapper group w-0 hidden xl:w-[248px] xl:block">
            <div id="bodyOverlay"
                class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
            <div class="logo-segment">
                <a class="flex items-center" href="#">
                    <img src="{{ asset('logos/logo_gamch.svg') }}" class="black_logo" alt="logo" >
                    <img src="{{ asset('logos/logo_gamch.svg') }}" class="white_logo"
                        alt="logo">
                    <span class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">INICIO</span>
                </a>
                <!-- Sidebar Type Button -->
                <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
                    <iconify-icon class="sidebarDotIcon extend-icon text-slate-900 dark:text-slate-200"
                        icon="fa-regular:dot-circle"></iconify-icon>
                    <iconify-icon class="sidebarDotIcon collapsed-icon text-slate-900 dark:text-slate-200"
                        icon="material-symbols:circle-outline"></iconify-icon>
                </div>
                <button class="sidebarCloseIcon text-2xl inline-block md:hidden">
                    <iconify-icon class="text-slate-900 dark:text-slate-200"
                        icon="clarity:window-close-line"></iconify-icon>
                </button>
            </div>
            <div id="nav_shadow"
                class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none opacity-0">
            </div>
            <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] z-50" id="sidebar_menus">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-title">MENU</li>
                    <li class="">
                        <a href="{{ route('inicio') }}"
                            class="navItem @if ($menu == '0') {{ 'active' }} @endif">
                            <span class="flex items-center">
                                <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                                <span>Inicio</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End: Sidebar -->
        <div class="flex flex-col justify-between min-h-screen" style="background-image: url(../imagenes/chulumani.jpg); background-size: cover;">
            <div >
                @include('plantilla_admin.header')
                <!-- END: Header -->
                <!-- END: Header -->
                <div class="content-wrapper transition-all duration-150 xl:ltr:ml-[248px] xl:rtl:mr-[248px]"
                    id="content_wrapper" >
                    <div class="page-content">
                        <div id="content_layout">
                            <div class="grid lg:grid-cols-7 md:grid-cols-3 sm:grid-cols-3 grid-cols-1 gap-5">

                                @if (Auth::user()->hasRole('admin'))
                                    <div class="bg-slate-900 dark:bg-slate-800 mb-10 mt-7 p-4 relative text-center rounded-2xl text-white">
                                        <img src="{{ asset('imagenes/sistemas.png') }}" width="55%" alt=""
                                            class="mx-auto relative -mt-[40px]">
                                        <div class="max-w-[160px] mx-auto mt-6">
                                            <div class="widget-title">Acceso</div>
                                            <div class="text-xs font-normal">
                                                Solo para administradores del sistema
                                            </div>
                                        </div>
                                        <div class="mt-6">
                                            <a href="{{ route('sistemas') }}"
                                                class="btn bg-white hover:bg-opacity-80 text-slate-900 btn-sm w-full block">
                                                SISTEMAS
                                            </a>
                                        </div>
                                    </div>
                                @endif



                                <div class="bg-primary-500 mb-10 mt-7 p-4 relative text-center rounded-2xl text-white">
                                    <img src="{{ asset('imagenes/recaudaciones.png') }}" width="50%" alt=""
                                        class="mx-auto relative -mt-[40px]">
                                    <div class="max-w-[160px] mx-auto mt-6">
                                        <div class="widget-title">Acceso</div>
                                        <div class="text-xs font-normal">
                                            Solo para la recaudacion de fondos
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <a href="{{ route('recaudaciones') }}"
                                            class="btn bg-white hover:bg-opacity-80 text-slate-900 btn-sm w-full block">
                                            RECAUDACIONES
                                        </a>
                                    </div>
                                </div>

                                <div class="bg-danger-900 mb-10 mt-7 p-4 relative text-center rounded-2xl text-white">
                                    <img src="{{ asset('imagenes/caja.png') }}" width="50%" alt=""
                                        class="mx-auto relative -mt-[40px]">
                                    <div class="max-w-[160px] mx-auto mt-6">
                                        <div class="widget-title">Acceso</div>
                                        <div class="text-xs font-normal">
                                            Solo para la administracion de caja
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <a href="{{ route('caja') }}"
                                            class="btn bg-white hover:bg-opacity-80 text-slate-900 btn-sm w-full block">
                                            CAJA
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('plantilla_admin.footer')
        </div>
    </main>
    <!-- scripts -->
    @include('plantilla_admin.scripts')
</body>

</html>
