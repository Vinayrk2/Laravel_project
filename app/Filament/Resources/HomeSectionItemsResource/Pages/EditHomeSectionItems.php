<?php

namespace App\Filament\Resources\HomeSectionItemsResource\Pages;

use App\Filament\Resources\HomeSectionItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeSectionItems extends EditRecord
{
    protected static string $resource = HomeSectionItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
