<x-filament::section :aside="true" :heading="__('filament-saas::default.users.profile.phone.title')" :description="__('filament-saas::default.users.profile.phone.description')">
    {{ $this->form }}

    <div class="mt-6 text-right">
        <x-filament::button type="submit" form="submit" class="align-right">
            {{ __('filament-saas::default.users.profile.phone.submit') }}
        </x-filament::button>
    </div>
</x-filament::section>
