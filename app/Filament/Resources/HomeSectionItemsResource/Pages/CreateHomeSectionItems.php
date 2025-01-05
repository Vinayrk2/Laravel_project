<?php

namespace App\Filament\Resources\HomeSectionItemsResource\Pages;

use App\Filament\Resources\HomeSectionItemsResource;
use App\Models\HomeSectionItems;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateHomeSectionItems extends CreateRecord
{
    protected static string $resource = HomeSectionItemsResource::class;

    protected function beforeCreate(): void
    {
        $count = HomeSectionItems::count();
        
        if ($count >= 6) {
            Notification::make()
                ->title('Maximum limit reached')
                ->body('You can only have 6 home section items.')
                ->danger()
                ->send();

            $this->halt();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
