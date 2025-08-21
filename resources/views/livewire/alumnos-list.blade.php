<div class="p-6 bg-white dark:bg-neutral-800 rounded-xl shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Alumnos de la Comisión') }} {{ $this->comision }}
        </h2>

        <div class="inline-flex rounded-md border border-gray-200 dark:border-gray-700 overflow-hidden">
            <button
                type="button"
                wire:click="setComision('2.1')"
                class="px-3 py-1.5 text-sm transition
                    {{ $this->comision === '2.1'
                        ? 'bg-blue-600 text-white'
                        : 'bg-transparent text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-700' }}">
                2.1
            </button>
            <button
                type="button"
                wire:click="setComision('2.2')"
                class="px-3 py-1.5 text-sm transition border-l border-gray-200 dark:border-gray-700
                    {{ $this->comision === '2.2'
                        ? 'bg-blue-600 text-white'
                        : 'bg-transparent text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-700' }}">
                2.2
            </button>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-neutral-700">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Legajo</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Nombre</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Email</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Teléfono</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-600 dark:text-gray-300">DNI</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse($alumnos as $alumno)
                <tr>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->legajo }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->email }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->phone ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">{{ $alumno->dni ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-sm text-center text-gray-500 dark:text-gray-400">
                        {{ __('No hay alumnos en la Comisión') }} {{ $this->comision }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
