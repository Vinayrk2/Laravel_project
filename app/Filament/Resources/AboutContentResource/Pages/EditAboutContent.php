<?php

namespace App\Filament\Resources\AboutContentResource\Pages;

use App\Filament\Resources\AboutContentResource;
use App\Models\AboutContent;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutContent extends EditRecord
{
    protected static string $resource = AboutContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mount($record = null): void
    {
        // Always work with the record with ID 1
        $this->record = AboutContent::firstOrCreate(['id' => 1]);
    }
}
