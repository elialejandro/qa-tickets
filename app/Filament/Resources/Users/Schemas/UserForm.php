<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        $isEdit = !!$schema->getRecord();

        return $schema
            ->components([

                Grid::make($isEdit ? 2 : 1)
                    ->schema([
                        Section::make('User Details')
                            ->columns($isEdit ? 1 : 2)
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('password')
                                    ->password()
                                    ->required(fn(string $context): bool => $context === 'create')
                                    ->maxLength(255)
                                    ->visibleOn('create')
                                    ->mutateDehydratedStateUsing(fn(string $state): string => Hash::make($state))
                                    ->rule(Password::default()),

                                Select::make('roles')
                                    ->relationship('roles', 'name')
                                    ->multiple()
                                    ->native(false)
                                    ->preload(),


                            ])
                            ->columnSpan(1),

                        Section::make('User New Password')
                            ->schema([
                                TextInput::make('new_password')
                                    ->nullable()
                                    ->password()
                                    ->rule(Password::default()),
                                TextInput::make('new_password_confirmation')
                                    ->password()
                                    ->same('new_password')
                                    ->requiredWith('new_password'),
                            ])
                            ->visibleOn('edit')
                            ->columnSpan(1),
                    ])
                    ->columnSpanFull(),

            ]);
    }
}
