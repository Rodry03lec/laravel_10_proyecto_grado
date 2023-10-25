<div class="z-[9]" id="app_header">
    <div class="app-header z-[999] bg-white dark:bg-slate-800 shadow-sm dark:shadow-slate-700">
        <div class="flex justify-between items-center h-full">
            <div class="flex items-center md:space-x-4 space-x-4 rtl:space-x-reverse vertical-box">
                <a href="index.html" class="mobile-logo xl:hidden inline-block">
                    <img src="{{ asset('logos/logo_gamch.svg') }}" class="black_logo" alt="logo">
                    <img src="{{ asset('logos/logo_gamch.svg') }}" class="white_logo" alt="logo">
                </a>
                <button class="smallDeviceMenuController open-sdiebar-controller hidden xl:hidden md:inline-block">
                    <iconify-icon class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                </button>
                <button class="sidebarOpenButton text-xl text-slate-900 dark:text-white !ml-0 hidden rtl:rotate-180">
                    <iconify-icon icon="ph:arrow-right-bold"></iconify-icon>
                </button>
                <button class="flex items-center xl:text-sm text-lg xl:text-slate-400 text-slate-800 dark:text-slate-300 focus:outline-none focus:shadow-none px-1 space-x-3 rtl:space-x-reverse search-modal" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <iconify-icon icon="heroicons-outline:search"></iconify-icon>
                    <span class="xl:inline-block hidden">Search...</span>
                </button>
            </div>
            <!-- end vertcial -->
            <div class="items-center space-x-4 rtl:space-x-reverse horizental-box">
                <a href="index.html" class="leading-0">
                    <span class="xl:inline-block hidden">
                        <img src="{{ asset('logos/logo_gamch.svg') }}" class="black_logo " alt="logo">
                        <img src="{{ asset('logos/logo_gamch.svg') }}" class="white_logo" alt="logo">
                    </span>
                    <span class="xl:hidden inline-block">
                        <img src="{{ asset('logos/logo_gamch.svg') }}" class="black_logo " alt="logo">
                        <img src="{{ asset('logos/logo_gamch.svg') }}" class="white_logo " alt="logo">
                    </span>
                </a>
                <button class="smallDeviceMenuController open-sdiebar-controller hidden md:inline-block xl:hidden">
                    <iconify-icon class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                </button>
                <button class="items-center xl:text-sm text-lg xl:text-slate-400 text-slate-800 dark:text-slate-300 focus:outline-none focus:shadow-none px-1 space-x-3 rtl:space-x-reverse search-modal inline-flex xl:hidden" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <iconify-icon icon="heroicons-outline:search"></iconify-icon>
                    <span class="xl:inline-block hidden">Search...</span>
                </button>
            </div>
            <!-- end horizental -->
            <!-- end top menu -->
            <div class="nav-tools flex items-center lg:space-x-5 space-x-3 rtl:space-x-reverse leading-0">
                <!-- BEGIN: Language Dropdown  -->
                <div class="relative">
                    <button class="text-slate-800 dark:text-white focus:ring-0 focus:outline-none font-medium rounded-lg text-sm text-center inline-flex items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon icon="circle-flags:bo" class="mr-0 md:mr-2 rtl:ml-2 text-xl"></iconify-icon>
                        <span class="text-sm md:block hidden font-medium text-slate-600 dark:text-slate-300">BOL</span>
                    </button>
                </div>
                <!-- Theme Changer -->
                <!-- END: Language Dropdown -->
                <!-- BEGIN: Toggle Theme -->
                <div>
                    <button id="themeMood" class="h-[28px] w-[28px] lg:h-[32px] lg:w-[32px] lg:bg-gray-500-f7 bg-slate-50 dark:bg-slate-900 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center">
                        <iconify-icon class="text-slate-800 dark:text-white text-xl dark:block hidden" id="moonIcon" icon="line-md:sunny-outline-to-moon-alt-loop-transition"></iconify-icon>
                        <iconify-icon class="text-slate-800 dark:text-white text-xl dark:hidden block" id="sunIcon" icon="line-md:moon-filled-to-sunny-filled-loop-transition"></iconify-icon>
                    </button>
                </div>
                <!-- END: TOggle Theme -->
                <!-- BEGIN: grayscal -->
                <div>
                    <button id="grayScale" class="lg:h-[32px] lg:w-[32px] lg:bg-slate-100 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center">
                        <iconify-icon class="text-slate-800 dark:text-white text-xl" icon="mdi:paint-outline"></iconify-icon>
                    </button>
                </div>
                <!-- END: grayscal -->
                <!-- BEGIN: Message Dropdown -->
                <!-- Mail Dropdown -->

                <!-- END: Message Dropdown -->
                <!-- BEGIN: Notification Dropdown -->
                <!-- Notifications Dropdown area -->
                {{-- <div class="relative md:block hidden">
                    <button class="lg:h-[32px] lg:w-[32px] lg:bg-slate-50 lg:dark:bg-slate-900 dark:text-white text-slate-900 cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon class="animate-tada text-slate-800 dark:text-white text-xl" icon="heroicons-outline:bell"></iconify-icon>
                        <span class="absolute -right-1 lg:top-0 -top-[6px] h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center justify-center rounded-full text-white z-[99]"> 4</span>
                    </button>
                    <!-- Notifications Dropdown -->
                    <div class="dropdown-menu z-10 hidden bg-white divide-y divide-slate-100 dark:divide-slate-900 shadow w-[335px] dark:bg-slate-800 border dark:border-slate-900 !top-[23px] rounded-md overflow-hidden lrt:origin-top-right rtl:origin-top-left">
                        <div class="flex items-center justify-between py-4 px-4">
                            <h3 class="text-sm font-Inter font-medium text-slate-700 dark:text-white">Notifications</h3>
                            <a class="text-xs font-Inter font-normal underline text-slate-500 dark:text-white" href="#">See All</a>
                        </div>
                        <div class="divide-y divide-slate-100 dark:divide-slate-900" role="none">
                            <div class="bg-slate-100 dark:bg-slate-700 dark:bg-opacity-70 text-slate-800 block w-full px-4 py-2 text-sm relative">
                                <div class="flex ltr:text-left rtl:text-right">
                                    <div class="flex-none ltr:mr-3 rtl:ml-3">
                                        <div class="h-8 w-8 bg-white rounded-full">
                                            <img src="{{ asset('admin_template/images/all-img/user.png') }}" alt="user" class="border-white block w-full h-full object-cover rounded-full border">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <a href="#" class="text-slate-600 dark:text-slate-300 text-sm font-medium mb-1 before:w-full before:h-full before:absolute before:top-0 before:left-0">Your order is placed</a>
                                        <div class="text-slate-500 dark:text-slate-200 text-xs leading-4">Amet minim mollit non deser unt ullamco est sit aliqua.</div>
                                        <div class="text-slate-400 dark:text-slate-400 text-xs mt-1">3 min ago</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-slate-600 dark:text-slate-300 block w-full px-4 py-2 text-sm">
                                <div class="flex ltr:text-left rtl:text-right relative">
                                    <div class="flex-none ltr:mr-3 rtl:ml-3">
                                        <div class="h-8 w-8 bg-white rounded-full">
                                            <img src="{{ asset('admin_template/images/all-img/user2.png') }}" alt="user" class="border-transparent block w-full h-full object-cover rounded-full border">
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <a href="#" class="text-slate-600 dark:text-slate-300 text-sm font-medium mb-1 before:w-full before:h-full before:absolute before:top-0 before:left-0">Congratulations Darlene 🎉</a>
                                        <div class="text-slate-600 dark:text-slate-300 text-xs leading-4">Won the monthly best seller badge</div>
                                        3 min ago
                                    </div>
                                </div>
                                <div class="flex-0">
                                    <span class="h-[10px] w-[10px] bg-danger-500 border border-white dark:border-slate-400 rounded-full inline-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: Notification Dropdown -->

                <!-- BEGIN: Profile Dropdown -->
                <!-- Profile DropDown Area -->
                <div class="md:block hidden w-full">
                    <button class="text-slate-800 dark:text-white focus:ring-0 focus:outline-none font-medium rounded-lg text-sm text-center inline-flex items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="lg:h-8 lg:w-8 h-7 w-7 rounded-full flex-1 ltr:mr-[10px] rtl:ml-[10px]">
                            @if (Auth::user()->perfil !== NULL)
                                <img src="{{ asset('perfil/'.Auth::user()->perfil) }}" alt="user" class="block w-full h-full object-cover rounded-full">
                            @else
                                <img src="{{ asset('perfil/perfil.png') }}" alt="user" class="block w-full h-full object-cover rounded-full">
                            @endif


                        </div>
                        <span class="flex-none text-slate-600 dark:text-white text-sm font-normal items-center lg:flex hidden overflow-hidden text-ellipsis  whitespace-nowrap">{{ Auth::user()->nombres.' '.Auth::user()->apellido_paterno  }}</span>
                        <svg class="w-[16px] h-[16px] dark:text-white hidden lg:inline-block text-base inline-block ml-[10px] rtl:mr-[10px]" aria-hidden="true" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu z-10 hidden bg-white divide-y divide-slate-100 shadow w-44 dark:bg-slate-800 border dark:border-slate-700 !top-[23px] rounded-md overflow-hidden">
                        <ul class="py-1 text-sm text-slate-800 dark:text-slate-200">
                            <li>
                                <a href="javascript:void(0);" class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600  dark:text-white font-normal" data-bs-toggle="modal" data-bs-target="#modal_perfil">
                                    <iconify-icon icon="heroicons-outline:user" class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                    <span class="font-Inter">Perfil</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" id="btn-cerrar-session" class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white font-inter text-sm text-slate-600 dark:text-white font-normal">
                                    <iconify-icon icon="heroicons-outline:login" class="relative top-[2px] text-lg ltr:mr-1 rtl:ml-1"></iconify-icon>
                                    <span class="font-Inter">Salir</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form id="formulario_salir">@csrf</form>
                </div>


                <!-- END: Header -->
                <button class="smallDeviceMenuController md:hidden block leading-0">
                    <iconify-icon class="cursor-pointer text-slate-900 dark:text-white text-2xl" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                </button>
            <!-- end mobile menu -->
            </div>
        <!-- end nav tools -->
        </div>
    </div>
</div>

<!-- BEGIN: Search Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto inset-0 bg-slate-900/40 backdrop-filter backdrop-blur-sm backdrop-brightness-10" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form>
                <div class="relative">
                    <button class="absolute left-0 top-1/2 -translate-y-1/2 w-9 h-full text-xl dark:text-slate-300 flex items-center justify-center">
                        <iconify-icon icon="heroicons-solid:search"></iconify-icon>
                    </button>
                    <input type="text" class="form-control !py-[14px] !pl-10" placeholder="Search" autofocus>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: Search Modal -->


    <!-- Scrollable Modal Start -->
    <div id="modal_perfil" tabindex="-1" class="modal modal-izquierda fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" data-bs-backdrop="static">
        <div class="modal-dialog modal-md relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="relative w-full h-full max-w-2xl md:h-auto">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                        <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                            PERFIL
                        </h3>
                        <button type="button" onclick="cerrar_modal_perfil()" class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                            11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-2 space-y-6 max-h-[calc(100vh-200px)] overflow-y-auto" id="scrollModal">
                            <fieldset>
                                <legend>INFORMACIÓN PERSONAL</legend>
                                <form id="form_informacion_personal" class="space-y-4" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    {{-- <div class="input-area relative pl-28">
                                        <label for="largeInput" class="inline-inputLabel">Nombres</label>
                                        <div class="relative">
                                            <input type="text" class="form-control !pl-9" name="nombres" id="nombres" value="{{ Auth::user()->nombres }}" placeholder="Ingrese sus nombres">
                                            <iconify-icon icon="heroicons-outline:user" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="input-area relative pl-28">
                                        <label for="largeInput" class="inline-inputLabel">Ap. Paterno</label>
                                        <div class="relative">
                                            <input type="text" class="form-control !pl-9" name="apellido_paterno" id="apellido_paterno"  value="{{ Auth::user()->apellido_paterno }}" placeholder="Ingrese el apellido paterno">
                                            <iconify-icon icon="heroicons-outline:user" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="input-area relative pl-28">
                                        <label for="largeInput" class="inline-inputLabel">Ap. Materno</label>
                                        <div class="relative">
                                            <input type="text" class="form-control !pl-9" name="apellido_materno" id="apellido_materno"  value="{{ Auth::user()->apellido_materno }}" placeholder="Ingrese el apellido materno">
                                            <iconify-icon icon="heroicons-outline:user" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                                        </div>
                                    </div> --}}

                                    <div class="input-area">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="relative">
                                            <input  type="email" id="email" name="email" class="form-control pr-9" placeholder="Ingrese su email" value="{{ Auth::user()->email }}" >
                                        </div>
                                        <div id="_email" ></div>
                                        {{-- <span id="tooltip_name-error" class="error">Please enter your name</span> --}}
                                    </div>
                                    <div class="input-area">
                                        <label for="celular" class="form-label">Nº celular</label>
                                        <div class="relative">
                                            <input  type="cel" id="celular" name="celular" class="form-control pr-9" placeholder="Ingrese su numero de celular" value="{{ Auth::user()->celular }}">
                                        </div>
                                        <div id="_celular" ></div>
                                        {{-- <span id="tooltip_name-error" class="error">Please enter your name</span> --}}
                                    </div>

                                </form>
                                <div class="p-6 space-x-2 text-center">
                                    <button type="button" id="btn_informacion_personal" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>ACTUALIZACIÓN DE CONTRASEÑA</legend>
                                <form id="form_password" class="space-y-4" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                    <div class="input-area">
                                        <label for="password" class="form-label">Contraseña nueva</label>
                                        <div class="relative">
                                            <input type="password" id="password" name="password" class="form-control !pl-9" placeholder="Contraseña nueva">
                                            <iconify-icon icon="heroicons-outline:lock-closed" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                                        </div>
                                        <div id="_password" ></div>
                                    </div>

                                    <div class="input-area">
                                        <label for="confirmar_password" class="form-label">Repetir password</label>
                                        <div class="relative">
                                            <input type="password" id="confirmar_password" name="confirmar_password" class="form-control !pl-9" placeholder="Confirmar contraseña">
                                            <iconify-icon icon="heroicons-outline:lock-closed" class="absolute left-2 top-1/2 -translate-y-1/2 text-base text-slate-500"></iconify-icon>
                                        </div>
                                        <div id="_confirmar_password" ></div>
                                    </div>
                                </form>
                                <div class="p-6 space-x-2 text-center">
                                    <button type="button" id="btn_password" class="btn inline-flex justify-center text-white bg-black-500">Guardar</button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scrollable Modal End -->
