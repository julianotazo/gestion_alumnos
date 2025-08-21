<x-layouts.app :title="__('Bienvenida')">
    <div class="gap-6">

        <!-- Columna central -->
        <div class="">

            <div class="w-full rounded-xl overflow-hidden bg-white dark:bg-neutral-800 p-4">
                <img src="{{ asset('images/gestion_alumnos.png') }}" alt="Logo TiendApp"
                     class="mx-auto w-1/4 md:w-1/5 object-contain" />
            </div>

            <!-- Descripción -->
            <div
                class="text-sm text-gray-700 dark:text-gray-200 p-4 border border-neutral-300 dark:border-neutral-700 rounded-xl bg-white dark:bg-neutral-800">
                <img src="{{ asset('images/HORARIOS.jpg') }}" alt="horarios" class="block w-full h-auto"/>
            </div>
        </div>

    </div>
</x-layouts.app>