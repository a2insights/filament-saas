<?php

namespace A2Insights\FilamentSaas\User\Filament\Components;

use A2Insights\FilamentSaas\Features\Features;
use A2Insights\FilamentSaas\FilamentSaas;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class Phone extends MyProfileComponent
{
    protected string $view = 'filament-saas::user.livewire.phone';

    public static $sort = 10;

    public $user;

    public ?array $data = [];

    public function mount()
    {
        $this->user = Filament::getCurrentPanel()->auth()->user();
        $this->form->fill($this->user->only(['phone']));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                PhoneInput::make('phone')
                    ->defaultCountry('BR')
                    ->label(__('filament-saas::default.users.register.phone'))
                    ->unique(FilamentSaas::getUserModel(), ignorable: $this->user)
                    ->validateFor(
                        lenient: true,
                    )
                    ->required(),
            ])->statePath('data');
    }

    public static function canView(): bool
    {
        $features = App::make(Features::class);

        return $features->user_phone;
    }

    public function submit()
    {
        $data = collect($this->form->getState())->only(['phone'])->all();
        $this->user->update($data);

        Notification::make()
            ->success()
            ->title(__('filament-saas::default.users.profile.phone.notify'))
            ->send();
    }
}
