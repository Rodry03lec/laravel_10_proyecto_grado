<div class="card-body px-6 pb-6">
    <div class="overflow-x-auto -mx-2 dashcode-data-table">
        <span class=" col-span-8  hidden"></span>
        <span class="  col-span-4 hidden"></span>
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden w-full overflow-x-auto ">
                <table id="table_usuario" class="min-w-full table-auto divide-y divide-slate-100 dark:divide-slate-700 data-table" style="width: 100%">
                    <thead class=" bg-slate-200 dark:bg-slate-700">
                        <tr>
                            <th scope="col" class="table-th">#</th>
                            <th scope="col" class="table-th">USUARIO Y MODELO</th>
                            <th scope="col" class="table-th">DESCRIPCIÓN</th>
                            <th scope="col" class="table-th">FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listar_actividad as $actividad)
                            @php
                                $properties = json_decode($actividad->properties, true);
                            @endphp
                            <tr>
                                <td scope="col" class="table-td">{{ $loop->iteration }}</td>
                                <td scope="col" class="table-td">{{ $actividad->description }}</td>
                                <td scope="col" class="table-td"><pre>{{ json_encode($properties, JSON_PRETTY_PRINT) }}</pre></td>
                                <td scope="col" class="table-td">{{ $actividad->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
