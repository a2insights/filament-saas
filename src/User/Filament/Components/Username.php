<?php

namespace A2Insights\FilamentSaas\User\Filament\Components;

use A2Insights\FilamentSaas\Features\Features;
use A2Insights\FilamentSaas\FilamentSaas;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\App;
use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;

class Username extends MyProfileComponent
{
    protected string $view = 'filament-saas::user.livewire.username';

    public static $sort = 10;

    public $user;

    public ?array $data = [];

    public function mount()
    {
        $this->user = Filament::getCurrentPanel()->auth()->user();
        $this->form->fill($this->user->only(['username']));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')
                    ->label(__('filament-saas::default.users.profile.username.title'))
                    ->prefixIcon('heroicon-m-at-symbol')
                    ->unique(FilamentSaas::getUserModel(), ignorable: $this->user)
                    ->required()
                    ->rules(['required', 'max:100', 'min:4', 'string']),
            ])
            ->model($this->getFormModel())
            ->statePath('data')
            ->operation($this->getFormContext());
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
            ->title(__('filament-saas::default.users.profile.username.notify'))
            ->send();
    }
}
