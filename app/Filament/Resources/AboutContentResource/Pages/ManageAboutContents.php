<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use Filament\Resources\Pages\EditRecord;

class ManageAboutContents extends EditRecord
{
    protected static string $resource = AboutContentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
