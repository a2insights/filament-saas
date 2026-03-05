<?php

namespace A2Insights\FilamentSaas\User\Filament\Forms;

use A2Insights\FilamentSaas\FilamentSaas;
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
                    Section::make('Account Details')
                        ->schema([
                            TextInput::make('name')
                                ->label(__('Name'))
                                ->autofocus()
                                ->required()
                                ->maxLength(100)
                                ->placeholder(__('Name')),
                            TextInput::make('username')
                                ->label(__('Username'))
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label(__('Email'))
                                ->email()
                                ->required()
                                ->unique(FilamentSaas::getUserModel(), 'email', ignoreRecord: true)
                                ->maxLength(255)
                                ->placeholder(__('Email')),
                            TextInput::make('phone')
                                ->label(__('Phone'))
                                ->tel()
                                ->maxLength(255),
                            TextInput::make('password')
                                ->label(__('Password'))
                                ->password()
                                ->revealable()
                                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                ->dehydrated(fn ($state) => filled($state))
                                ->required(fn (string $context): bool => $context === 'create')
                                ->maxLength(255),
                        ])->columns(2),

                    Section::make('Profile & Settings')
                        ->schema([
                            \Filament\Forms\Components\FileUpload::make('avatar_url')
                                ->label(__('Avatar'))
                                ->avatar()
                                ->imageEditor()
                                ->circleCropper()
                                ->directory('avatars'),
                            Select::make('theme')
                                ->label(__('Theme'))
                                ->options([
                                    'light' => 'Light',
                                    'dark' => 'Dark',
                                    'system' => 'System',
                                ])
                                ->default('system'),
                            TextInput::make('theme_color')
                                ->label(__('Theme Color'))
                                ->maxLength(255),
                        ])->columns(2),
                ])
                ->columnSpan(['lg' => 2]),

            Group::make()
                ->schema([
                    Section::make('Access Control')
                        ->schema([
                            Select::make('roles')
                                ->label(__('Roles'))
                                ->relationship('roles', 'name')
                                ->preload()
                                ->multiple()
                                ->getOptionLabelFromRecordUsing(fn (Model $record) => Str::title($record->name)),
                            \Filament\Forms\Components\DateTimePicker::make('email_verified_at')
                                ->label(__('Email Verified At')),
                            \Filament\Forms\Components\DateTimePicker::make('banned_at')
                                ->label(__('Banned At')),
                        ]),

                    Section::make('System Information')
                        ->schema([
                            TextInput::make('id')
                                ->label('ID')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('created_at')
                                ->label('Created at')
                                ->disabled()
                                ->dehydrated(false)
                                ->formatStateUsing(fn (?Model $record) => $record?->created_at?->diffForHumans() ?? '-'),
                            TextInput::make('updated_at')
                                ->label('Last modified at')
                                ->disabled()
                                ->dehydrated(false)
                                ->formatStateUsing(fn (?Model $record) => $record?->updated_at?->diffForHumans() ?? '-'),
                        ]),
                ])
                ->columnSpan(['lg' => 1]),
        ])
            ->columns(3);
    }
}
