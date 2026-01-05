<?php

namespace App\Filament\Resources\TestCases\Schemas;

use App\Enums\TestCase\Priority;
use App\Enums\TestCase\Status;
use App\Filament\Resources\TestCases\Pages\CreateTestCase;
use App\Filament\Resources\TestCases\Pages\EditTestCase;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
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
                    Step::make('General')
                        ->schema(static::getStep1())
                        ->columns(),
                    Step::make('Details')
                        ->schema(static::getStep2()),
                    Step::make('Results')
                        ->schema(static::getStep3()),
                ])
                    ->columnSpanFull()
                    ->hidden(fn ($livewire) => $livewire instanceof EditTestCase),
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('General')
                            ->columns()
                            ->schema(static::getStep1()),
                        Tab::make('Details')
                            ->schema(static::getStep2()),
                        Tab::make('Expected Results')
                            ->schema(static::getStep3()),
                        Tab::make('Results')
                            ->schema([
                                RichEditor::make('result')
                                    ->required(),
                                Repeater::make('attachments')
                                    ->label('Attachments')
                                    ->relationship('attachments')
                                    ->schema([
                                        FileUpload::make('path')
                                            ->directory('attachments')
                                            ->storeFileNamesIn('filename')
                                            ->disk('public')
                                            ->visibility('public')
                                            ->required()
                                            ->columnSpanFull(),
                                        Textarea::make('description')
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->hidden(fn ($livewire) => $livewire instanceof CreateTestCase),
            ]);
    }

    private static function getStep1(): array
    {
        return [
            Hidden::make('owner_id')
                ->default(fn () => Auth::id()),
            TextInput::make('code')
                ->default(fn () => self::generateCode())
                ->required(),
            TextInput::make('module')
                ->required(),
            ToggleButtons::make('priority')
                ->inline()
                ->options(Priority::class)
                // ->options(['normal' => 'Normal', 'medium' => 'Medium', 'high' => 'High'])
                ->default('normal')
                ->required(),
            ToggleButtons::make('status')
                ->inline()
                ->options(Status::class)
                // ->options([
                //     'open' => 'Open',
                //     'in_course' => 'In course',
                //     'closed' => 'Closed',
                //     'review' => 'Review',
                //     'completed' => 'Completed',
                // ])
                ->default('open')
                ->required(),
            DateTimePicker::make('execution_at')
                ->hidden(fn ($livewire) => $livewire instanceof CreateTestCase),
            TextInput::make('version'),

        ];
    }

    private static function getStep2(): array
    {
        return [
            TextInput::make('title')
                ->required(),
            RichEditor::make('description')
                ->required()
                ->columnSpanFull(),
            RichEditor::make('predonditions')
                ->required(),
        ];
    }

    private static function getStep3(): array
    {
        return [
            RichEditor::make('steps_to_execute')
                ->required()
                ->columnSpanFull(),
            RichEditor::make('expected_result')
                ->required()
                ->columnSpanFull(),
        ];
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
