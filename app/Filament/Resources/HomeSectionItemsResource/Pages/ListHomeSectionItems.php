<?php

namespace App\Filament\Resources\HomeSectionItemsResource\Pages;

use App\Filament\Resources\HomeCaresoleImageResource;
use App\Filament\Resources\HomeSectionItemsResource;
use App\Models\HomeSectionItems;
use Filament\Resources\Pages\ListRecords;

class ListHomeSectionItems extends ListRecords
{
    protected static string $resource = HomeSectionItemsResource::class;

    protected function getActions(): array
    {
        $actions = parent::getActions();

        // Check the count of CatesoleImage records
        if (HomeSectionItems::count() >= 3) {
            // Remove the create action if there are already 4 items
            return array_filter($actions, fn ($action) => $action->getName() !== 'create');
        }

        return $actions;
    }
}
