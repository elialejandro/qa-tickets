<?php

namespace App\Filament\Resources\TestCases;

use App\Filament\Resources\TestCases\Pages\CreateTestCase;
use App\Filament\Resources\TestCases\Pages\EditTestCase;
use App\Filament\Resources\TestCases\Pages\ListTestCases;
use App\Filament\Resources\TestCases\Schemas\TestCaseForm;
use App\Filament\Resources\TestCases\Tables\TestCasesTable;
use App\Models\TestCase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TestCaseResource extends Resource
{
    protected static ?string $model = TestCase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'TestCase';

    public static function form(Schema $schema): Schema
    {
        return TestCaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestCasesTable::configure($table);
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
            'index' => ListTestCases::route('/'),
            'create' => CreateTestCase::route('/create'),
            'edit' => EditTestCase::route('/{record}/edit'),
        ];
    }
}
