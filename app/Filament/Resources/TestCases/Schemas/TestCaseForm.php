<?php

namespace App\Filament\Resources\TestCases\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TestCaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Step 1')
                        ->schema([
                            TextInput::make('owner_id')
                                ->hidden()
                                ->default(fn () => Auth::id())
                                ->numeric(),
                            TextInput::make('code')
                                ->required(),
                            TextInput::make('module')
                                ->required(),
                            ToggleButtons::make('priority')
                                ->inline()
                                ->options(['normal' => 'Normal', 'medium' => 'Medium', 'high' => 'High'])
                                ->default('normal')
                                ->required(),
                            ToggleButtons::make('status')
                                ->inline()
                                ->options([
                                    'open' => 'Open',
                                    'in_course' => 'In course',
                                    'closed' => 'Closed',
                                    'review' => 'Review',
                                    'completed' => 'Completed',
                                ])
                                ->default('open')
                                ->required(),
                            DateTimePicker::make('execution_at')
                                ->required(),
                            TextInput::make('version'),

                        ])
                        ->columns(),
                    Step::make('Step 2')
                        ->schema([
                            TextInput::make('title')
                                ->required(),
                            RichEditor::make('description')
                                ->required()
                                ->columnSpanFull(),
                            RichEditor::make('predonditions')
                                ->required(),
                        ]),
                    Step::make('Step 3')
                        ->schema([
                            RichEditor::make('steps_to_execute')
                                ->required()
                                ->columnSpanFull(),
                            RichEditor::make('expected_result')
                                ->required()
                                ->columnSpanFull(),
                        ]),
                ])
                ->columnSpanFull(),
            ]);
    }
}
