<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSectionItemsResource\Pages;
use App\Models\HomeSectionItems;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class HomeSectionItemsResource extends Resource
{
    protected static ?string $model = HomeSectionItems::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Home Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('home_id')
                    ->relationship('home', 'id') // Assuming 'id' is the identifying column in HomeSection
                    ->label('Home Section')
                    ->required(),
                TextInput::make('title')
                    ->label('Title')
                    ->required(),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(5),
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('uploads/home_section_items')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('home_id')
                    ->label('Home Section')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
                ImageColumn::make('image')
                    ->label('Image')
                    ->rounded(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeSectionItems::route('/'),
            'create' => Pages\CreateHomeSectionItems::route('/create'),
            'edit' => Pages\EditHomeSectionItems::route('/{record}/edit'),
        ];
    }
}
