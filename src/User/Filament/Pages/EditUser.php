<?php

namespace A2Insights\FilamentSaas\User\Filament\Pages;

use A2Insights\FilamentSaas\User\Filament\UserResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    // TODO: PR for upgrade Oimpersonate plugin
    // protected function getActions(): array
    // {
    //     return collect([
    //         Actions\DeleteAction::make()->disabled(fn () => $this->record->is(auth()->user()) || $this->record->hasRole('super_admin')),
    //     ])->when(
    //         auth()->user()->hasRole('super_admin') && ! $this->record->hasRole('super_admin'),
    //         fn ($actions) => $actions->push(\XliteDev\FilamentImpersonate\Pages\Actions\ImpersonateAction::make()->record($this->getRecord()))
    //     )->toArray();
    // }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-actions::edit.single.modal.actions.save.label'))
            ->disabled(fn () => $this->record->is(auth()->user()) || $this->record->hasRole('super_admin'))
            ->submit('save')
            ->keyBindings(['ctrl+s']);
    }
}
