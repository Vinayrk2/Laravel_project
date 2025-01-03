<?php

namespace App\Filament\Resources\HomeCaresoleImageResource\Pages;

use App\Filament\Resources\HomeCaresoleImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeCaresoleImage extends EditRecord
{
    protected static string $resource = HomeCaresoleImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
