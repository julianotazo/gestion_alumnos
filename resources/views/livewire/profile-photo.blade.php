<div class="text-center">
    {{-- Foto persistida en BD --}}
    <img
        src="{{ auth()->user()->avatar_url }}"
        alt="Foto de perfil"
        class="w-24 h-24 rounded-full object-cover mx-auto border"
    >

    {{-- Form para subir nueva foto --}}
    <form wire:submit.prevent="save" class="mt-4 flex items-center justify-center gap-3">
        {{-- input real oculto --}}
        <input id="photo" type="file" wire:model="photo" accept="image/*" class="sr-only">
        <label for="photo"
            class="inline-flex items-center justify-center rounded-lg border border-zinc-300 dark:border-zinc-700 px-4 py-2 cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
            {{ __('Seleccionar archivo') }}
        </label>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50"
                @disabled(!$photo)>
            {{ __('Guardar Foto') }}
        </button>
    </form>

    @error('photo')
        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
    @enderror

    {{-- Vista previa temporal (si seleccionaste un archivo) --}}
    @if ($photo)
        <div class="mt-3">
            <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover mx-auto" alt="Vista previa">
        </div>
    @endif

    {{-- Mensaje de éxito --}}
    @if (session()->has('message'))
        <div class="mt-2 text-emerald-600 text-sm">
            {{ session('message') }}
        </div>
    @endif
</div>
