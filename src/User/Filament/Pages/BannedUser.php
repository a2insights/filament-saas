<?php

namespace A2Insights\FilamentSaas\User\Filament\Pages;

use Cog\Laravel\Ban\Models\Ban;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Pages\BasePage;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Illuminate\Support\Facades\Auth;

// TODO: BannedUser needs to be upgraded
class BannedUser extends BasePage
{
    use InteractsWithFormActions;

    protected static ?string $title = null;

    protected Width|string|null $maxContentWidth = null;

    protected ?string $heading = '';

    protected static string $view = 'filament-saas::user.banned';

    public Ban $ban;

    public function mount()
    {
        if (! Auth::user()->isBanned() || ! Filament::auth()->check()) {
            return redirect(Filament::getCurrentPanel()->getLoginUrl());
        }

        $this->ban = Auth::user()->bans->first();
    }

    public function getTitle(): \Illuminate\Contracts\Support\Htmlable|string
    {
        return static::$title ?? (string) str(__('filament-lockscreen::default.heading'))
            ->kebab()
            ->replace('-', ' ')
            ->title();
    }

    public function hasLogo(): bool
    {
        return false;
    }

    protected function hasFullWidthFormActions(): bool
    {
        return true;
    }

    public function logout()
    {
        Filament::auth()->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect(Filament::getCurrentPanel()->getLoginUrl());
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('logout')->submit('logout'),
        ];
    }
}
