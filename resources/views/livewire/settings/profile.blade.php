<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Perfil')" :subheading="__('Actualizá tus datos personales')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">

            <flux:input wire:model.defer="name" :label="__('Nombre')" type="text" required autofocus autocomplete="name" />
            <div>
                <flux:input wire:model.defer="email" :label="__('Email')" type="email" required autocomplete="email" />
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <div class="mt-2">
                        <flux:text>
                            {{ __('Tu dirección de correo electrónico no está verificada.') }}
                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Hacé clic aquí para reenviar el correo de verificación.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('Se envió un nuevo enlace de verificación a tu correo.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <flux:input
                        wire:model.defer="phone"
                        :label="__('Teléfono')"
                        type="text"
                        autocomplete="phone"
                    />
                </div>

                <div>
                    <label>{{ __('Comisión') }}</label>
                    <select wire:model.defer="comision" required
                            class="w-full rounded-md border border-zinc-300 dark:border-zinc-700 p-2 bg-white dark:bg-zinc-900">
                        <option value="" disabled>{{ __('Seleccioná una opción') }}</option>
                        <option value="2.1">2.1</option>
                        <option value="2.2">2.2</option>
                    </select>
                </div>

                <div>
                    <flux:input
                        wire:model.defer="dni"
                        :label="__('DNI (7–10 dígitos)')"
                        type="text"
                        required
                        inputmode="numeric"
                        minlength="7"
                        maxlength="10"
                        pattern="^[0-9]{7,10}$"
                        autocomplete="dni"
                    />
                </div>

                <div>
                    <flux:input
                        wire:model.defer="legajo"
                        :label="__('Legajo (5 dígitos)')"
                        type="text"
                        required
                        inputmode="numeric"
                        minlength="5"
                        maxlength="5"
                        pattern="^[0-9]{5}$"
                        autocomplete="legajo"
                    /> 
                </div>
            </div>

            <!-- LinkedIn -->
            <flux:input
                name="linkedin_url"
                id="linkedin_url"
                wire:model.defer="linkedin_url"
                :label="__('LinkedIn (opcional)')"
                type="url"
                autocomplete="section-linkedin url"
            />

            <!-- GitHub -->
            <flux:input
                name="github_url"
                id="github_url"
                wire:model.defer="github_url"
                :label="__('GitHub (opcional)')"
                type="url"
                autocomplete="section-github url"
            />


            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">
                        {{ __('Guardar') }}
                    </flux:button>
                </div>
                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Guardado.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
