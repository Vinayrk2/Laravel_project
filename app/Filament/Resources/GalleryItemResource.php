<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Gallery Items';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('heading')
                ->label('Heading')
                ->required(),
            Forms\Components\HasManyRepeater::make('details')
                ->relationship('details')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Image')
                        ->directory('uploads/gallery')
                        ->nullable(),
                    Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->nullable(),
                ])
                ->label('Gallery Item Details'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('ID'),
            Tables\Columns\TextColumn::make('heading')
                ->label('Heading'),
            Tables\Columns\TextColumn::make('details_count')
                ->counts('details')
                ->label('Details Count'),
        ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
