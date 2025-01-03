<?php

namespace App\Filament\Resources\HomeCaresoleImageResource\Pages;

use App\Filament\Resources\HomeCaresoleImageResource;
use App\Models\HomeCaresoleImage;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeCaresoleImages extends ListRecords
{
    protected static string $resource = HomeCaresoleImageResource::class;

    protected function getActions(): array
    {
        $actions = parent::getActions();

        // Check the count of CatesoleImage records
        if (HomeCaresoleImage::count() >= 4) {
            // Remove the create action if there are already 4 items
            return array_filter($actions, fn ($action) => $action->getName() !== 'create');
        }

        return $actions;
    }
}
