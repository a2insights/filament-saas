<?php

namespace A2Insights\FilamentSaas\User\Livewire;

use A2Insights\FilamentSaas\User\UserPreferences;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Slider;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Support\RawJs;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class UserPreferencesSettings extends Component implements HasActions, HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    #[On('open-user-preferences')]
    public function triggerOpenPreferences(): void
    {
        $this->dispatch('close-modal', id: 'database-notifications');
        $this->mountAction('openPreferences');
    }

    public function openPreferences(): Action
    {
        return Action::make('openPreferences')
            ->label('Preferências')
            ->icon('heroicon-o-swatch')
            ->iconButton()
            ->tooltip('Preferências de Design & Sistema')
            ->color('gray')
            ->modalHeading('Preferências do Usuário')
            ->modalDescription('Personalize a sua experiência no sistema.')
            ->modalWidth('3xl')
            ->slideOver()
            ->extraModalWindowAttributes(['class' => 'user-preferences-modal'])
            ->fillForm(fn () => [
                'navigation_layout' => Auth::user()?->preferences?->navigation_layout ??
                    (Auth::user()?->hasAnyRole(['super_admin', 'admin']) ? 'sidebar' : 'top'),
                'zoom_level' => Auth::user()?->preferences?->zoom_level ?? 100,
                'app_theme' => Auth::user()?->preferences?->app_theme ?? 'default',
            ])
            ->schema([
                Section::make('Temas')
                    ->description('Escolha o estilo visual do sistema.')
                    ->schema([
                        ViewField::make('app_theme')
                            ->view('filament-saas::user.theme-selector')
                            ->live()
                            ->afterStateUpdated(fn ($state, $component) => $component->getLivewire()->dispatch('update-theme', theme: $state))
                            ->default('default'),
                        ViewField::make('color_mode')
                            ->view('filament-saas::user.color-mode-switcher')
                            ->hiddenLabel(),
                    ]),

                Section::make('Navegação')
                    ->description('Escolha o estilo do menu principal.')
                    ->schema([
                        ToggleButtons::make('navigation_layout')
                            ->label('Estilo do Menu')
                            ->options([
                                'sidebar' => 'Menu Lateral',
                                'top' => 'Menu Superior',
                            ])
                            ->inline()
                            ->icons([
                                'sidebar' => 'heroicon-o-bars-3-bottom-left',
                                'top' => 'heroicon-o-ellipsis-horizontal',
                            ]),

                    ]),

                Section::make('Acessibilidade & Zoom')
                    ->description('Ajuste o redimensionamento da interface.')
                    ->schema([
                        Slider::make('zoom_level')
                            ->label('Escala da Interface')
                            ->helperText('Ajuste o redimensionamento do sistema.')
                            ->minValue(80)
                            ->maxValue(120)
                            ->step(5)
                            ->live()
                            ->afterStateUpdated(fn ($state, $component) => $component->getLivewire()->dispatch('update-zoom', zoom: $state))
                            ->tooltips(
                                RawJs::make(<<<'JS'
                                    `${$value.toFixed(2)}%`
                                JS)
                            )
                            ->pips(density: 5)
                            ->pipsFilter(RawJs::make(<<<'JS'
                                $value === 100 
                                    ? 1 
                                    : ($value === 80 || $value === 120 ? 1 : 0)
                            JS)),
                    ]),
            ])
            ->modalSubmitActionLabel('Salvar e Aplicar')
            ->modalCancelActionLabel('Cancelar')
            ->action(function (array $data) {
                $user = Auth::user();
                $oldPreferences = $user->preferences;

                $user->update([
                    'preferences' => UserPreferences::from([
                        ...($user->preferences?->toArray() ?? []),
                        ...$data,
                    ]),
                ]);

                $this->dispatch('update-zoom', zoom: $data['zoom_level']);

                if (
                    ($oldPreferences?->navigation_layout !== $data['navigation_layout']) ||
                    ($oldPreferences?->app_theme !== $data['app_theme'])
                ) {
                    return redirect(request()->header('Referer'));
                }

                Notification::make()
                    ->title('Preferências atualizadas!')
                    ->success()
                    ->send();
            });
    }

    public function render()
    {
        return <<<'BLADE'
            <div>
                {{ $this->openPreferences }}
                <x-filament-actions::modals />
            </div>
        BLADE;
    }
}
