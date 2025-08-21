<div>
    {{-- Mostrar foto actual si existe --}}
    @if(auth()->user()->photo_path)
        <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" 
             alt="Foto de perfil" 
             class="w-24 h-24 rounded-full object-cover">
    @endif

    {{-- Input para subir nueva foto --}}
    <form wire:submit.prevent="save" class="mt-4">
        <input type="file" wire:model="photo">

        @error('photo') 
            <span class="text-red-500">{{ $message }}</span> 
        @enderror

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
            Guardar Foto
        </button>
    </form>

    {{-- Mensaje de éxito --}}
    @if (session()->has('message'))
        <div class="mt-2 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</div>
