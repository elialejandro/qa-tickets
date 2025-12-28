<?php

namespace App\Filament\Resources\TestCases\Pages;

use App\Filament\Resources\TestCases\TestCaseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTestCase extends CreateRecord
{
    protected static string $resource = TestCaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['owner_id'] = Auth::id();
        $data['result'] = '';

        return $data;
    }
}
