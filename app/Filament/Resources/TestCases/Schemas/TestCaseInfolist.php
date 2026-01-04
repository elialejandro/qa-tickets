<?php

namespace App\Filament\Resources\TestCases\Schemas;

use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestCaseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('General')
                            ->schema([
                                TextEntry::make('owner_id')
                                    ->numeric(),
                                TextEntry::make('reviewed_by')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('code'),
                                TextEntry::make('module'),
                                TextEntry::make('priority')
                                    ->badge()
                                    ,
                                TextEntry::make('status')
                                    ->badge(),
                                TextEntry::make('execution_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('version')
                                    ->placeholder('-'),
                                TextEntry::make('title'),
                            ])
                            ->columns(),
                        Tabs\Tab::make('Details')
                            ->schema([
                                TextEntry::make('description')
                                    ->html()
                                    ->columnSpanFull(),
                                TextEntry::make('predonditions')
                                    ->html()
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Expected Results')
                            ->schema([
                                TextEntry::make('steps_to_execute')
                                    ->html()
                                    ->columnSpanFull(),
                                TextEntry::make('expected_result')
                                    ->html()
                                    ->columnSpanFull(),
                            ]),
                        Tabs\Tab::make('Results')
                            ->schema([
                                TextEntry::make('result')   
                                    ->html()
                                    ->columnSpanFull(),
                                RepeatableEntry::make('attachments')
                                    ->table([
                                        TableColumn::make('Attachment'),
                                        TableColumn::make('description'),
                                    ])
                                    ->schema([
                                        ImageEntry::make('path')
                                            ->label('Attachment'),
                                        TextEntry::make('description')
                                            ->label('Description'),
                                    ])
                                    ->columns()
                                    ->contained(false),
                            ]),
                        Tabs\Tab::make('Metadata')
                            ->schema([
                                TextEntry::make('created_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('updated_at')
                                    ->dateTime()
                                    ->placeholder('-'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
