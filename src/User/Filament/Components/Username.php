<?php

namespace A2insights\FilamentSaas\User\Filament\Components;

use A2insights\FilamentSaas\Features\Features;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class Username extends MyProfileComponent
{
    protected string $view = 'filament-saas::user.livewire.phone';

    public static $sort = 10;

    public $user;

    public ?array $data = [];

    public function mount()
    {
        $this->user = Filament::getCurrentPanel()->auth()->user();
        $this->form->fill($this->user->only(['username']));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->label(__('filament-saas::default.user.profile.username.title'))
                    ->prefixIcon('heroicon-m-at-symbol')
                    ->unique(A2insights\FilamentSaas::getUserModel(), ignorable: $this->user)
                    ->required()
                    ->rules(['required', 'max:100', 'min:4', 'string']),
            ])->statePath('data');
    }

    public static function canView(): bool
    {
        $features = App::make(Features::class);

        return $features->username;
    }

    public function submit()
    {

        $data = collect($this->form->getState())->only(['username'])->all();
        $this->user->update($data);

        Notification::make()
            ->success()
            ->title(__('filament-saas::default.user.profile.username.notify'))
            ->send();
    }
}
