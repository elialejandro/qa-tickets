<?php

namespace App\Filament\Resources\TestCases\Pages;

use App\Filament\Resources\TestCases\TestCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTestCases extends ListRecords
{
    protected static string $resource = TestCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
