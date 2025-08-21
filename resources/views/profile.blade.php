<x-layouts.app :title="__('Perfil')">
    <div class="max-w-2xl mx-auto">

        <div class="border border-neutral-300 dark:border-neutral-700 rounded-2xl p-6 bg-white dark:bg-neutral-800 text-center">
            {{-- Foto de perfil centrada (con edición) --}}
            <div class="flex flex-col items-center">
                <livewire:profile-photo />
            </div>

            {{-- Nombre + Rol --}}
            <h1 class="mt-4 text-2xl font-semibold text-gray-900 dark:text-white">
                {{ auth()->user()->name }}
            </h1>
            <div class="mt-1">
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                             {{ auth()->user()->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ auth()->user()->is_admin ? __('Administrador') : __('Alumno') }}
                </span>
            </div>

            {{-- Info básica --}}
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Correo') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 break-all">{{ auth()->user()->email }}</div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Teléfono') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ auth()->user()->phone ?? __('No registrado') }}
                    </div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60 sm:col-span-2">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Enlaces') }}</div>
                    <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-3 text-sm">
                        {{-- URL Profesional (LinkedIn, portfolio, etc.) --}}
                        @if(auth()->user()->professional_url)
                            <a href="{{ auth()->user()->professional_url }}"
                               target="_blank" rel="noopener noreferrer"
                               class="text-blue-600 hover:underline">
                                {{ auth()->user()->professional_url }}
                            </a>
                        @else
                            <span class="text-gray-900 dark:text-gray-100">{{ __('Sin URL profesional') }}</span>
                        @endif

                        {{-- GitHub (preparado para el futuro, si agregás la columna `github_url`) --}}
                        @if(data_get(auth()->user(), 'github_url'))
                            <span class="text-gray-400">•</span>
                            <a href="{{ auth()->user()->github_url }}"
                               target="_blank" rel="noopener noreferrer"
                               class="text-gray-700 dark:text-gray-300 hover:underline">
                                GitHub
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                {{-- Ruta de ajustes/edición de datos (ajustá si usás otra) --}}
                <a href="{{ route('settings.profile') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    {{ __('Editar datos') }}
                </a>
            </div>
        </div>

    </div>
</x-layouts.app>
