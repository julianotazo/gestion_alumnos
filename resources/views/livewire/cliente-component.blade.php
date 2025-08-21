
<div class="p-4 sm:p-6 max-w-7xl mx-auto font-poppins text-gray-900 dark:text-gray-100">

    <div class="bg-gray-100 dark:bg-gray-800 shadow-lg rounded-xl p-6 mb-6">
        <span class="ml-2">Listado de los Alumnos de Programación IV  -  </span>
        <strong>Comisión:</strong>
        <span class="text-[#C1272D] font-semibold">2.1</span>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 px-4 py-3 mb-4 rounded-lg shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-gray-100 dark:bg-gray-800 rounded-xl shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-[#C1272D] text-white">
                <tr>
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Apellido</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Teléfono</th>
                    <th class="px-4 py-3">Domicilio</th>
                    <th class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3">{{ $cliente->nombre }}</td>
                        <td class="px-4 py-3">{{ $cliente->apellido }}</td>
                        <td class="px-4 py-3">{{ $cliente->email }}</td>
                        <td class="px-4 py-3">{{ $cliente->telefono }}</td>
                        <td class="px-4 py-3">{{ $cliente->domicilio }}</td>
                        <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                            <button wire:click="edit({{ $cliente->id }})"
                                class="text-green-600 dark:text-blue-400 hover:underline">Ver Detalle</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>