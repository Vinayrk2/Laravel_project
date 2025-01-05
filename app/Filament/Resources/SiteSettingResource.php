<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Resources\Resource;
use Filament\Forms;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('site_name')
                ->label('Site Name')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),
            Forms\Components\TextInput::make('phone_number_1')
                ->label('Phone Number 1')
                ->nullable(),
            Forms\Components\TextInput::make('phone_number_2')
                ->label('Phone Number 2')
                ->nullable(),
            Forms\Components\TextInput::make('bussiness_email')
                ->label('Business Email')
                ->email()
                ->required(),
            Forms\Components\TextInput::make('currency_rate')
                ->label('Currency Rate')
                ->numeric()
                ->required(),
            Forms\Components\Textarea::make('address')
                ->label('Address')
                ->nullable(),
            Forms\Components\Textarea::make('airport')
                ->label('Airport')
                ->nullable(),
            Forms\Components\TextInput::make('email_app_password')
                ->label('Email App Password')
                ->password()
                ->nullable(),
            Forms\Components\TextInput::make('tax')
                ->label('Tax')
                ->numeric()
                ->required(),
            Forms\Components\TextInput::make('instagram')
                ->label('Instagram')
                ->url()
                ->nullable(),
            Forms\Components\TextInput::make('youtube')
                ->label('YouTube')
                ->url()
                ->nullable(),
            Forms\Components\TextInput::make('linkedin')
                ->label('LinkedIn')
                ->url()
                ->nullable(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }


    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => 1]);
    }

    public static function afterSave(): void
    {
        // Clear the site settings cache after saving
        SiteSetting::clearCache();
    }

    public static function afterDelete(): void
    {
        // Clear the site settings cache after deleting
        SiteSetting::clearCache();
    }
}
