<?php

namespace App\Filament\Resources\TestCases\Pages;

use App\Filament\Resources\TestCases\TestCaseResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTestCase extends ViewRecord
{
    protected static string $resource = TestCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
