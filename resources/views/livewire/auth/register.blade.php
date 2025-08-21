<div class="max-w-md w-full mx-auto flex flex-col gap-6">
    <x-auth-header :title="__('Crea una cuenta')" :description="__('Ingresa aquí abajo los detalles para crear tu cuenta')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Nombre -->
        <flux:input
            wire:model.defer="name"
            :label="__('Nombre')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nombre completo')"
        />
        @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <!-- Correo -->
        <flux:input
            wire:model.defer="email"
            :label="__('Correo electrónico')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@ejemplo.com"
        />
        @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Teléfono (opcional) -->
            <div>
                <flux:input
                    wire:model.defer="phone"
                    :label="__('Teléfono')"
                    type="text"
                    autocomplete="tel"
                    placeholder="+54 9 351 ..."
                />
                @error('phone') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Comisión -->
            <div>
                <label class="font-medium block mb-1">{{ __('Comisión') }}</label>
                <select
                    wire:model.defer="comision"
                    required
                    class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 p-2 bg-white dark:bg-zinc-900"
                >
                    <option value="">{{ __('Seleccioná una opción') }}</option>
                    <option value="2.1">2.1</option>
                    <option value="2.2">2.2</option>
                </select>
                @error('comision') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- DNI -->
            <div>
                <flux:input
                    wire:model.defer="dni"
                    :label="__('DNI')"
                    type="text"
                    required
                    inputmode="numeric"
                    minlength="7"
                    maxlength="10"
                    pattern="^[0-9]{7,10}$"
                    placeholder="Ej: 1234567"
                />
                @error('dni') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Legajo -->
            <div>
                <flux:input
                    wire:model.defer="legajo"
                    :label="__('Legajo')"
                    type="text"
                    required
                    inputmode="numeric"
                    minlength="5"
                    maxlength="5"
                    pattern="^[0-9]{5}$"
                    placeholder="Ej: 01234"
                />
                @error('legajo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- LinkedIn -->
        <flux:input
            wire:model.defer="linkedin_url"
            :label="__('LinkedIn (opcional)')"
            type="url"
            placeholder="https://www.linkedin.com/in/usuario"
        />
        @error('linkedin_link') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <!-- Github -->
        <flux:input
            wire:model.defer="github_url"
            :label="__('GitHub (opcional)')"
            type="url"
            placeholder="https://github.com/usuario"
        />
        @error('github_link') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <!-- Foto de perfil-->
        <div class="flex flex-col gap-2">
            <label class="font-medium">{{ __('Foto de perfil (opcional)') }}</label>

            <input id="photo" type="file" wire:model="photo" accept="image/*" class="sr-only">
            <div class="flex items-center gap-3">
                <label for="photo"
                    class="inline-flex items-center justify-center rounded-lg border border-zinc-300 dark:border-zinc-700 px-4 py-2 cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                    {{ __('Seleccionar archivo') }}
                </label>
                <span class="text-sm text-zinc-600 dark:text-zinc-400">
                    @if ($photo)
                        {{ $photo->getClientOriginalName() ?? __('Archivo seleccionado') }}
                    @else
                        {{ __('Ningún archivo seleccionado') }}
                    @endif
                </span>
            </div>

            @error('photo')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror

            {{-- Vista previa cuando el archivo se selecciona --}}
            @if ($photo)
                <div class="mt-2">
                    <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover" alt="Preview">
                </div>
            @endif
        </div>

        <!-- Contraseña -->
        <flux:input
            wire:model.defer="password"
            :label="__('Contraseña')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Contraseña')"
            viewable
        />
        @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <!-- Confirmar Contraseña -->
        <flux:input
            wire:model.defer="password_confirmation"
            :label="__('Confirmar contraseña')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmar contraseña')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button
                type="submit"
                variant="primary"
                class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-lg shadow-md transition"
            >
                {{ __('Crear cuenta') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('¿Ya tenés una cuenta?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Iniciar Sesión') }}</flux:link>
    </div>
</div>
