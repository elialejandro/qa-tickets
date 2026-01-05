<?php

namespace App\Filament\Resources\TestCases\Pages;

use App\Enums\TestCase\Status;
use App\Filament\Resources\TestCases\TestCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;

class ListTestCases extends ListRecords
{
    protected static string $resource = TestCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'open' => Tab::make()->label('Open')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::OPEN)),
            'in_course' => Tab::make()->label('In Course')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::IN_COURSE)),
            'closed' => Tab::make()->label('Closed')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::CLOSED)),
            'review' => Tab::make()->label('Review')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::REVIEW)),
            'completed' => Tab::make()->label('Completed')
                ->modifyQueryUsing(fn ($query) => $query->where('status', Status::COMPLETED)),
        ];
    }
}
