<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use App\Filament\Resources\AboutContentResource;
use App\Models\AboutContent;
use Filament\Resources\Pages\EditRecord;

class EditAboutContent extends EditRecord
{
    protected static string $resource = AboutContentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount($record = null): void
    {
        $this->record = AboutContent::getContent();
    }
}
