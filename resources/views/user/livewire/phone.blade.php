<x-filament::section :aside="true" md=2 :heading="{{ __('filament-saas::default.users.profile.username.title') }}"
    :description="{{ __('filament-saas::default.users.profile.phone.description') }}">
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-6">

            {{ $this->form }}

            <div class="text-right">
                <x-filament::button type="submit" form="submit" class="align-right">
                    {{ __('filament-saas::default.users.profile.phone.submit') }}
                </x-filament::button>
            </div>
        </form>
    </x-filament::card>
</x-filament::section>