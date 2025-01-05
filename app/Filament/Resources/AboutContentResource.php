<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutContentResource\Pages;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('main_description')
                    ->label('Main Description')
                    ->required(),
                Forms\Components\TextInput::make('field1')
                    ->label('Field 1')
                    ->required(),
                Forms\Components\Textarea::make('field1_description')
                    ->label('Field 1 Description')
                    ->required(),
                Forms\Components\TextInput::make('field2')
                    ->label('Field 2')
                    ->required(),
                Forms\Components\Textarea::make('field2_description')
                    ->label('Field 2 Description')
                    ->required(),
                Forms\Components\TextInput::make('field3')
                    ->label('Field 3')
                    ->required(),
                Forms\Components\Textarea::make('field3_description')
                    ->label('Field 3 Description')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_description')
                    ->label('Main Description')
                    ->limit(50),
                Tables\Columns\TextColumn::make('field1')
                    ->label('Field 1'),
                Tables\Columns\TextColumn::make('field2')
                    ->label('Field 2'),
                Tables\Columns\TextColumn::make('field3')
                    ->label('Field 3'),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }

    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => 1]);
    }
}
