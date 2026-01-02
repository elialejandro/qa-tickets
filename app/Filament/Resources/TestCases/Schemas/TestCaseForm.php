<?php

namespace App\Filament\Resources\TestCases\Schemas;

use App\Filament\Resources\TestCases\Pages\CreateTestCase;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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
                            Hidden::make('owner_id')
                                ->default(fn () => Auth::id()),
                            TextInput::make('code')
                                ->default(fn () => self::generateCode())
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
                                ->hidden(fn ($livewire) => $livewire instanceof CreateTestCase),
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

    private static function generateCode(): string
    {
        return IdGenerator::generate([
            'table' => 'test_cases',
            'field' => 'code',
            'length' => 10,
            'prefix' => 'TC-',
            'reset_on_prefix_change' => true,
        ]);
    }
}
