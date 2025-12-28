<?php

namespace App\Filament\Resources\TestCases\Pages;

use App\Filament\Resources\TestCases\TestCaseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTestCase extends EditRecord
{
    protected static string $resource = TestCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
