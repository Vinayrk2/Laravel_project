<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutSectionResource\Pages;
use App\Models\AboutSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AboutSectionResource extends Resource
{
    protected static ?string $model = AboutSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Forms\Components\BelongsToSelect::make('about_content_id')
                    ->relationship('aboutContent', 'main_description')
                    ->label('About Content')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title'),
                Forms\Components\Textarea::make('description')
                    ->label('Description'),
                Forms\Components\Repeater::make('column')
                    ->label('Columns')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Column Value')
                            ->required(),
                    ])
                    ->required()
                    ->columns(1)
                    ->saveRelationshipsUsing(function ($component, $state) {
                        return json_encode($state); // Convert the array to JSON before saving
                    })
                ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('aboutContent.main_description')
                    ->label('About Content')
                    ->limit(55),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAboutSections::route('/'),
        ];
    }
}
