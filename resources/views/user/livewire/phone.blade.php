
<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-saas::default.users.profile.phone.title') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-saas::default.users.profile.phone.description') }}
    </x-slot>

    <x-filament::section>
         <form wire:submit.prevent="submit" class="space-y-6">

            {{ $this->form }}

            <div class="text-right">
                <x-filament::button type="submit" form="submit" class="align-right">
                    {{ __('filament-saas::default.users.profile.phone.submit') }}
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>
</x-filament-companies::grid-section>