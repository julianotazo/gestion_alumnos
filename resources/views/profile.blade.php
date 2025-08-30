<x-layouts.app :title="__('Perfil')">
  @php
    $user = auth()->user();
    $isAdmin = (bool) ($user->is_admin ?? false);
    $photo   = $user?->photo_path ? asset('storage/'.$user->photo_path) : asset('images/default-avatar.png');
    $email   = $user?->email ?? '';
    $name    = $user?->name ?? '';
    $dni     = $user?->dni ?? null;
    $legajo  = $user?->legajo ?? null;
    $comision= $user?->comision ?? null;
    $phone   = $user?->phone ?? null;
    $linkedin= $user?->linkedin_url ?? null;
    $github  = $user?->github_url ?? null;
    $whatsNumber = $phone ? preg_replace('/[^0-9]/', '', $phone) : null; // wa.me exige solo dígitos
  @endphp

  <div class="max-w-2xl mx-auto">

    <div class="border border-neutral-300 dark:border-neutral-700 rounded-2xl p-6 bg-white dark:bg-neutral-800 text-center">

      {{-- Foto --}}
      <div class="flex flex-col items-center">
        <img src="{{ $photo }}"
             alt="Foto de perfil"
             class="w-24 h-24 rounded-full object-cover mx-auto border border-neutral-300 dark:border-neutral-700">
      </div>

      <h1 class="mt-4 text-2xl font-semibold text-gray-900 dark:text-white">
        {{ $name }}
      </h1>

      {{-- Info básica --}}
      <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
        {{-- Correo --}}
        <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
          <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Correo') }}</div>
          <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 break-all">
            @if($email)
              <a href="mailto:{{ $email }}" class="hover:underline">{{ $email }}</a>
            @else
              <span class="text-gray-500 dark:text-gray-400">{{ __('No registrado') }}</span>
            @endif
          </div>
        </div>

        {{-- Teléfono (WhatsApp) --}}
        <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
          <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Teléfono') }}</div>
          <div class="mt-1 text-sm text-gray-900 dark:text-gray-100">
            @if($whatsNumber)
              <a href="https://wa.me/{{ $whatsNumber }}" target="_blank" rel="noopener noreferrer"
                 class="flex items-center gap-2 text-green-600 hover:underline">
                {{-- Ícono WhatsApp --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512" fill="currentColor" aria-hidden="true">
                  <path d="M380.9 97.1C339-2.3 229.3-33.2 136.9 20.7 54.5 68.7 19.2 166.2 49.6 256l-32.6 119.5c-3.5 12.7 8.4 24.1 20.8 19.8l118.2-32.9c85.4 45.9 191.3 14.1 239.2-68.1 44.3-77.2 25.6-174.3-25.3-238.2z"/>
                </svg>
                {{ $phone }}
              </a>
            @else
              <span class="text-gray-500 dark:text-gray-400">{{ __('No registrado') }}</span>
            @endif
          </div>
        </div>

        {{-- DNI --}}
        <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
          <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('DNI') }}</div>
          <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-mono">
            {{ $dni ?? __('No registrado') }}
          </div>
        </div>

        {{-- Legajo --}}
        <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
          <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Legajo') }}</div>
          <div class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-mono">
            {{ $legajo ?? __('No registrado') }}
          </div>
        </div>

        {{-- Comisión --}}
        <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
          <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Comisión') }}</div>
          <div class="mt-1 text-sm text-gray-900 dark:text-gray-100">
            @if(!empty($comision))
              <span class="inline-flex items-center rounded-md border border-neutral-300 dark:border-neutral-600 px-2 py-0.5 text-xs">
                {{ $comision }}
              </span>
            @else
              <span class="text-gray-500 dark:text-gray-400">{{ __('No registrada') }}</span>
            @endif
          </div>
        </div>

        {{-- Enlaces --}}
        <div class="border border-neutral-200 dark:border-neutral-700 rounded-xl p-4 bg-white/60 dark:bg-neutral-800/60">
          <div class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">{{ __('Enlaces') }}</div>
          <div class="mt-2 flex flex-wrap items-center justify-center sm:justify-start gap-4 text-sm">

            {{-- LinkedIn --}}
            @if(!empty($linkedin))
              <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer"
                 class="flex items-center gap-1 text-blue-600 hover:underline">
                {{-- Ícono LinkedIn --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512" fill="currentColor" aria-hidden="true">
                  <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8 0 24.1 24.1 0 53.79 0s53.8 24.1 53.8 53.8-24.09 54.3-53.8 54.3zM447.9 448h-92.4V304.1c0-34.3-.7-78.3-47.7-78.3-47.8 0-55.1 37.3-55.1 75.9V448h-92.5V148.9h88.8v40.8h1.3c12.4-23.4 42.7-48.1 87.9-48.1 94 0 111.3 61.9 111.3 142.3V448z"/>
                </svg>
                LinkedIn
              </a>
            @endif

            {{-- Separador si hay ambos --}}
            @if(!empty($linkedin) && !empty($github))
              <span class="text-gray-400">•</span>
            @endif

            {{-- GitHub --}}
            @if(!empty($github))
              <a href="{{ $github }}" target="_blank" rel="noopener noreferrer"
                 class="flex items-center gap-1 text-gray-700 dark:text-gray-300 hover:underline">
                {{-- Ícono GitHub --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 496 512" fill="currentColor" aria-hidden="true">
                  <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-2.9 0-5.2-1.6-5.2-3.6 0-2 2.3-3.6 5.2-3.6zm-32.3-2.3c-.7 1.6.7 3.4 3.2 4.1 2.5.7 5.2 0 5.9-1.6.7-1.6-.7-3.4-3.2-4.1-2.5-.6-5.2 0-5.9 1.6zm44.2-1.2c-2.9 0-5.2 1.6-5.2 3.6s2.3 3.6 5.2 3.6c2.9 0 5.2-1.6 5.2-3.6-.1-2-.3-3.6-5.2-3.6zM248 8C111 8 0 119 0 256c0 110.5 69.8 204.1 166.5 237 12.2 2.2 16.8-5.3 16.8-11.8 0-5.8-.2-25.3-.4-45.9-67.7 14.7-81.9-32.7-81.9-32.7-11-27.8-26.8-35.2-26.8-35.2-21.9-15 1.6-14.7 1.6-14.7 24.2 1.7 36.9 24.9 36.9 24.9 21.5 36.9 56.4 26.2 70.2 20 2.1-15.6 8.3-26.2 15.1-32.2-54.1-6.2-111-27.1-111-120.6 0-26.7 9.5-48.6 25-65.7-2.5-6.2-10.8-31.3 2.4-65.1 0 0 20.4-6.5 67 25 19.4-5.4 40.2-8.1 60.8-8.2s41.4 2.8 60.8 8.2c46.6-31.5 67-25 67-25 13.2 33.8 4.9 58.9 2.4 65.1 15.6 17.1 25 39 25 65.7 0 93.7-56.9 114.3-111.1 120.6 8.6 7.5 16.3 22.4 16.3 45.2 0 32.6-.3 59-.3 67 0 6.5 4.6 14 16.8 11.7C426.2 460.1 496 366.5 496 256 496 119 385 8 248 8z"/>
                </svg>
                GitHub
              </a>
            @endif

            @if(empty($linkedin) && empty($github))
              <span class="text-gray-500 dark:text-gray-400">{{ __('Sin enlaces') }}</span>
            @endif
          </div>
        </div>
      </div>

      {{-- Acciones --}}
      <div class="mt-6 flex flex-wrap justify-center gap-3">
        <a href="{{ route('settings.profile') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
          {{ __('Editar datos') }}
        </a>
      </div>
    </div>
  </div>
</x-layouts.app>
