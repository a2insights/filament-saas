<?php

namespace A2Insights\FilamentSaas\User\Filament;

use A2Insights\FilamentSaas\User\Filament\Pages\CreateUser;
use A2Insights\FilamentSaas\User\Filament\Pages\EditUser;
use A2Insights\FilamentSaas\User\Filament\Pages\ListUsers;
use A2Insights\FilamentSaas\User\Filament\Pages\ViewUser;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = -2;

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('filament-saas::default.users.navigation.user', 2);
    }

    public static function getModelLabel(): string
    {
        return trans_choice('filament-saas::default.users.navigation.user', 1);
    }

    public static function getPluralModelLabel(): string
    {
        return trans_choice('filament-saas::default.users.navigation.user', 2);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function isScopedToTenant(): bool
    {
        return config('filament-saas.users.tenant_scope', false);
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->name . ' - ' . $record->email;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema(Card::class))
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function getFormSchema(string $layout = Grid::class): array
    {
        return [
            Group::make()
                ->schema([
                    $layout::make()
                        ->schema([
                            Placeholder::make('id')
                                ->label('ID')
                                ->content(fn (?Model $record): string => $record ? $record->id : '-'),
                            TextInput::make('name')
                                ->autofocus()
                                ->required()
                                ->placeholder(__('Name'))
                                ->rules(['required', 'max:100', 'min:3', 'string']),
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->unique(static::$model, 'email', ignoreRecord: true)
                                ->placeholder(__('Email')),
                            TextInput::make('password')
                                ->password()
                                ->hidden(static function (?Model $record): ?bool {
                                    return $record?->exists;
                                })
                                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                ->placeholder(__('Password')),
                            Select::make('roles')
                                ->relationship('roles', 'name')
                                ->preload()
                                ->multiple()
                                ->getOptionLabelFromRecordUsing(fn (Model $record) => Str::title($record->name))
                                ->required(),
                        ]),

                ])
                ->columnSpan(2),
            Group::make()
                ->schema([
                    $layout::make()
                        ->schema([
                            Placeholder::make('created_at')
                                ->label('Created at')
                                ->content(fn (?Model $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                            Placeholder::make('updated_at')
                                ->label('Last modified at')
                                ->content(fn (?Model $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            Placeholder::make('email_verified_at')
                                ->label('Email verified at')
                                ->content(fn (?Model $record): string => $record?->email_verified_at ? $record->email_verified_at->diffForHumans() : '-'),
                        ]),
                ])
                ->columnSpan(1),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable('desc')
                    ->toggleable(),
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->copyable()
                    ->copyMessage('Email copied to clipboard')
                    ->searchable()
                    ->toggleable(),
                ToggleColumn::make('email_verified_at')
                    ->label('Email verified')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->offColor('danger')
                    ->onColor('success')
                    ->alignCenter()
                    ->sortable()
                    ->updateStateUsing(fn ($state, Model $record) => $record->forceFill(['email_verified_at' => $state ? now() : null])->save())
                    ->disabled(fn ($record) => ! Auth::user()->hasRole('super_admin') || $record->hasRole('super_admin'))
                    ->toggleable(),
                TextColumn::make('roles.name')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'admin' => 'warning',
                        'user' => 'success',
                        default => 'primary',
                    })
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->sortable('desc')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                \Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter::make('created_at'),
                Tables\Filters\Filter::make('email_verified_at')->label('Not verified')->query(fn (Builder $query) => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                \XliteDev\FilamentImpersonate\Tables\Actions\ImpersonateAction::make()
                    ->visible(fn ($record) => Auth::user()->hasRole('super_admin') && ! $record->hasRole('super_admin'))
                    ->iconButton(),
                \Widiu7omo\FilamentBandel\Actions\BanAction::make()
                    ->visible(fn ($record) => Auth::user()->hasRole('super_admin') && ! $record->isBanned() && ! $record->hasRole('super_admin'))
                    ->iconButton()
                    ->successNotification(function ($record) {
                        $ban = $record->bans()->first();

                        Notification::make()
                            ->title('You have been banned')
                            ->danger()
                            ->body($ban?->comment)
                            ->sendToDatabase($record);
                    }),
                \Widiu7omo\FilamentBandel\Actions\UnbanAction::make()
                    ->visible(fn ($record) => Auth::user()->hasRole('super_admin') && $record->isBanned() && ! $record->hasRole('super_admin'))
                    ->iconButton()
                    ->successNotification(function ($record) {
                        Notification::make()
                            ->title('You have been unbanned')
                            ->success()
                            ->sendToDatabase($record);
                    }),
                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => ! $record->is(Auth::user()) && ! $record->hasRole('super_admin'))
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => ! $record->is(Auth::user()) && ! $record->hasRole('super_admin'))
                    ->iconButton(),
                Tables\Actions\ForceDeleteAction::make()->iconButton()->visible(fn ($record) => ! $record->is(Auth::user()) && ! $record->hasRole('super_admin') && $record->trashed()),
                Tables\Actions\RestoreAction::make()->iconButton(),
            ])
            ->bulkActions([
                \Widiu7omo\FilamentBandel\Actions\BanBulkAction::make('banned_model'),
                \Widiu7omo\FilamentBandel\Actions\UnbanBulkAction::make('unbanned_model'),
                Tables\Actions\DeleteBulkAction::make()->action(fn (Collection $records) => $records->filter(fn ($record) => ! $record->is(Auth::user()) && ! $record->hasRole('super_admin'))->each->delete()),
                Tables\Actions\ForceDeleteBulkAction::make()->action(fn (Collection $records) => $records->filter(fn ($record) => ! $record->is(Auth::user()) && ! $record->hasRole('super_admin'))->each->forceDelete()),
                Tables\Actions\RestoreBulkAction::make(),
            ])->checkIfRecordIsSelectableUsing(
                fn (Model $record): bool => ! $record->hasRole('super_admin'),
            );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
            'view' => ViewUser::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
