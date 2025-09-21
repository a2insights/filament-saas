<x-filament::section :aside="true" :heading="{{ __('filament-saas::default.users.profile.username.title') }}"
    :description="{{ __('filament-saas::default.users.profile.username.description') }}">
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-6">

            {{ $this->form }}

            <div class="text-right">
                <x-filament::button type="submit" form="submit" class="align-right">
                    {{ __('filament-saas::default.users.profile.username.submit') }}
                </x-filament::button>
            </div>
        </form>
    </x-filament::card>
</x-filament::section>
