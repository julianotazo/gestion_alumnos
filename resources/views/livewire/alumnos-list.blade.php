<div class="p-6 bg-white dark:bg-neutral-800 rounded-xl shadow">
    <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">
        {{ __('Lista de Alumnos Registrados') }}
    </h2>

    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-neutral-700">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">ID</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Nombre</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Email</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Teléfono</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Enlace</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($alumnos as $alumno)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->email }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->phone ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-blue-500">
                        @if($alumno->professional_url)
                            <a href="{{ $alumno->professional_url }}" target="_blank" class="hover:underline">
                                {{ __('Ver perfil') }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
