<x-layouts.app :title="__('Perfil')">
    @php($user = auth()->user())
    <div class="max-w-2xl mx-auto">

        <div class="border border-neutral-300 dark:border-neutral-700 rounded-2xl p-6 bg-white dark:bg-neutral-800 text-center">

            <div class="flex flex-col items-center">
                <livewire:profile-photo />
                @isset($user->is_admin)
                    @if($user->is_admin)
                        <span class="mt-2 inline-flex items-center rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-200 px-3 py-0.5 text-xs font-medium">
                            {{ __('Administrador') }}
                        </span>
                    @endif
                @endisset
            </div>

            <h1 class="mt-4 text-2xl font-semibold text-gray-900 dark:text-white">
                {{ $user->name }}
            </h1>

            {{-- Info básica --}}
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Correo') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 break-all">
                        <a href="mailto:{{ $user->email }}" class="hover:underline">{{ $user->email }}</a>
                    </div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Teléfono') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        @if($user->phone)
                            <a href="tel:{{ preg_replace('/\s+/', '', $user->phone) }}" class="hover:underline">{{ $user->phone }}</a>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">{{ __('No registrado') }}</span>
                        @endif
                    </div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('DNI') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-mono">
                        {{ $user->dni ?? __('No registrado') }}
                    </div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Legajo') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-mono">
                        {{ $user->legajo ?? __('No registrado') }}
                    </div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60 sm:col-span-2">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Comisión') }}</div>
                    <div class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        @if($user->comision)
                            <span class="inline-flex items-center rounded-md border border-neutral-300 dark:border-neutral-600 px-2 py-0.5 text-xs">
                                {{ $user->comision }}
                            </span>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">{{ __('No registrada') }}</span>
                        @endif
                    </div>
                </div>

                <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60 sm:col-span-2">
                    <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Enlaces') }}</div>

                    <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-3 text-sm">
                        @if($user->linkedin_url || $user->github_url)
                            @if($user->linkedin_url)
                                <a href="{{ $user->linkedin_url }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="text-blue-600 hover:underline">
                                    LinkedIn
                                </a>
                            @endif

                            @if($user->linkedin_url && $user->github_url)
                                <span class="text-gray-400">•</span>
                            @endif

                            @if($user->github_url)
                                <a href="{{ $user->github_url }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="text-gray-700 dark:text-gray-300 hover:underline">
                                    GitHub
                                </a>
                            @endif
                        @else
                            <span class="text-gray-500 dark:text-gray-400">{{ __('Sin enlaces') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Acciones --}}
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                <a href="{{ route('settings.profile') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    {{ __('Editar datos') }}
                </a>
            </div>
        </div>

    </div>
</x-layouts.app>
