<?php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditSiteSetting extends EditRecord
{
    protected static string $resource = SiteSettingResource::class;

    // protected static ?string $recordTitleAttribute = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mount($record = null): void
    {
        // Always work with the record with ID 1
        $this->record = SiteSetting::firstOrCreate(['id' => 1]);
    }
    public function getRecord(): \Illuminate\Database\Eloquent\Model
    {
        // Always return the singleton record
        return static::getModel()::firstOrCreate(['id' => 1]);
    }

    // protected function getRedirectUrl(): string
    // {
    //     // Redirect back to the same edit page after saving
    //     return static::getResource()::getUrl('edit');
    // }
}
