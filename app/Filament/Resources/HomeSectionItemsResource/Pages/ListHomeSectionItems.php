<?php

namespace App\Filament\Resources\HomeSectionItemsResource\Pages;

use App\Filament\Resources\HomeSectionItemsResource;
use App\Models\HomeSectionItems;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeSectionItems extends ListRecords
{
    protected static string $resource = HomeSectionItemsResource::class;

    protected function getHeaderActions(): array
    {
        $itemCount = HomeSectionItems::count();

        return [
            $itemCount < 6 
                ? Actions\CreateAction::make() 
                : null,
        ];
    }
}
