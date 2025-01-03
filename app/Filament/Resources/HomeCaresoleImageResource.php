<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeCaresoleImageResource\Pages;
use App\Models\HomeCaresoleImage;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeCaresoleImageResource extends Resource
{
    protected static ?string $model = HomeCaresoleImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Home Management'; // Optional: Categorize in the sidebar.

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('home_id')
                    ->relationship('home', 'id') // Use the relationship method and display the title.
                    ->required()
                    ->label('Home Section'),
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->directory('uploads/carasole_images') // Customize your upload path.
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('home.title') // Assuming `HomeSection` has a `title` column.
                    ->label('Home Section')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('image')
                    ->label('Image')
                    ->url(fn ($record) => asset('storage/' . $record->image)) // Display image path.
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relationships if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeCaresoleImages::route('/'),
            'create' => Pages\CreateHomeCaresoleImage::route('/create'),
            'edit' => Pages\EditHomeCaresoleImage::route('/{record}/edit'),
        ];
    }
}