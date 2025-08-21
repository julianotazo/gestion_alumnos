<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Crea una cuenta')" :description="__('Ingresa aquí abajo los detalles para crear tu cuenta')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Nombre -->
        <flux:input
            wire:model="name"
            :label="__('Nombre')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nombre completo')"
        />

        <!-- Correo -->
        <flux:input
            wire:model="email"
            :label="__('Correo electrónico')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@ejemplo.com"
        />

        <!-- Teléfono -->
        <flux:input
            wire:model="phone"
            :label="__('Teléfono')"
            type="text"
            autocomplete="tel"
            placeholder="+54 9 351 ..."
        />

        <!-- URL Profesional -->
        <flux:input
            wire:model="professional_url"
            :label="__('URL Profesional')"
            type="url"
            placeholder="https://www.linkedin.com/in/usuario"
        />

        <!-- Foto de perfil -->
        <div class="flex flex-col gap-2">
            <label class="font-medium">{{ __('Foto de perfil (opcional)') }}</label>
            <input type="file" wire:model="photo" accept="image/*">
            @error('photo')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror>

            {{-- Vista previa cuando el archivo se selecciona --}}
            @if ($photo)
                <div class="mt-2">
                    <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="Preview">
                </div>
            @endif
        </div>

        <!-- Contraseña -->
        <flux:input
            wire:model="password"
            :label="__('Contraseña')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Contraseña')"
            viewable
        />

        <!-- Confirmar Contraseña -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirmar contraseña')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmar contraseña')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Crear cuenta') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('¿Ya tenés una cuenta?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Iniciar Sesión') }}</flux:link>
    </div>
</div>