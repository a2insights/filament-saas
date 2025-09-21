<?php

namespace A2Insights\FilamentSaas\User\Filament\Forms;

use A2Insights\FilamentSaas\FilamentSaas;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Group::make()
                ->schema([
                    Section::make()
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
                                ->unique(FilamentSaas::getUserModel(), 'email', ignoreRecord: true)
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
                    Section::make()
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
        ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }
}
