@foreach ($sub_categoria as $lis)
    <tr>
        <td class="table-td">{{ $loop->iteration }}</td>
        <td scope="col" class="table-td">{{ $lis->nombre }}</td>
        <td scope="col" class="table-td">{{ $lis->descripcion }}</td>
        <td scope="col" class="table-td">{{ con_separador_comas($lis->precio_fijo).' Bs' }}</td>
        <td scope="col" class="table-td">
            <div class="flex space-x-3 rtl:space-x-reverse">
                <button class="action-btn btn-warning" onclick="editar_sub_categoria('{{ $lis->id }}')" type="button">
                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                </button>
                <button class="action-btn btn-danger" onclick="eliminar_sub_categoria('{{ $lis->id }}', '{{ $lis->id_categoria }}')" type="button">
                <iconify-icon icon="heroicons:trash"></iconify-icon>
                </button>
            </div>
        </td>
    </tr>
@endforeach
