<?php

namespace App\Filament\Resources\TestCases\Pages;

use App\Filament\Resources\TestCases\TestCaseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTestCase extends CreateRecord
{
    protected static string $resource = TestCaseResource::class;
}
