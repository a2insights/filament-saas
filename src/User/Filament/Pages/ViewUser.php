<?php

namespace A2Insights\FilamentSaas\User\Filament\Pages;

use A2Insights\FilamentSaas\User\Filament\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make()->disabled(fn () => $this->record->is(auth()->user()) || $this->record->hasRole('super_admin')),
            Actions\EditAction::make()->disabled(fn () => $this->record->is(auth()->user())),
        ];
    }
}
