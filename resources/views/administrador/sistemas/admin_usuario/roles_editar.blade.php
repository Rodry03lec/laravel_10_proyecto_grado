<form method="POST" id="form_editar_rol" autocomplete="off">
    @csrf
    <input type="hidden" name="id_rol" id="id_rol" value="{{ $id }}">
    <div class="input-area">
        <label for="nombre_rol_" class="form-label">Nombre del rol</label>
        <input id="nombre_rol_" name="nombre_rol_" value="{{ $roles_edi->name }}" type="text" class="form-control"
            placeholder="Ingrese un rol">
        <div id="_nombre_rol_"></div>
    </div>

    <header class="flex mt-5 items-center text-center border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
        <div class="flex-1">
            <div class="card-title text-slate-400 dark:text-white" style="font-size: 15px !important">Seleccione los Permisos</div>
        </div>
    </header>

    @if ($permiso->isEmpty())
        <div class="alert alert-danger light-mode">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <iconify-icon class="text-2xl flex-0" icon="system-uicons:target"></iconify-icon>
                <p class="flex-1 font-Inter">
                    ! No existe nigun permiso ¡
                </p>
            </div>
        </div>
    @else

        <div class="card-text h-full space-y-4">
            <div class="flex items-center space-x-2 flex-wrap">
                <div class="checkbox-area">
                    <label class="inline-flex items-center cursor-pointer" for="marcar_des_edi">
                        <input type="checkbox" class="hidden" id="marcar_des_edi"  onclick="marcar_desmarcar_edi(this);">
                        <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                            <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                        <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Seleccionar todos</span>
                    </label>
                </div>
            </div>
        </div>

        <table class="table mt-4">
            <tbody>
                @forelse ($permiso as $id => $value)
                    <tr>
                        <td>
                            <div class="flex items-center space-x-2 flex-wrap">
                                <div class="checkbox-area primary-checkbox">
                                    <label class="inline-flex items-center cursor-pointer" for="{{ $value }}">
                                        <input type="checkbox" class="placeholder-shown:border-gray-500 hidden" name="permisos_edi[]" id="{{ $value }}" value="{{ $id }}" {{ $roles_edi->permissions->contains($id) ? 'checked' : '' }}>
                                        <span class="h-4 w-4 border flex-none border-slate-100 dark:border-slate-800 rounded inline-flex ltr:mr-3 rtl:ml-3 relative transition-all duration-150 bg-slate-100 dark:bg-slate-900">
                                            <img src="{{ asset('admin_template/images/icon/ck-white.svg') }}" alt="" class="h-[10px] w-[10px] block m-auto opacity-0"></span>
                                        <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">{{ $value }}</span>
                                    </label>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                -----
                @endforelse
            </tbody>
        </table>
    @endif
</form>
