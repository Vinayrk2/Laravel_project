<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\Categories;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Products';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('part_number')
                    ->label('Part Number')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\Repeater::make('images')
                    ->relationship('images') // Define the hasMany relationship
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->directory('product_images') // Directory to save the images
                            ->image()
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->label('Product Images'),
                Forms\Components\Textarea::make('features')
                    ->label('Features')
                    ->rows(5),
                Forms\Components\Textarea::make('more_details')
                    ->label('More Details')
                    ->rows(5),
                Forms\Components\TextInput::make('manufacturer')
                    ->label('Manufacturer'),
                Forms\Components\Select::make('condition')
                    ->label('Condition')
                    ->options([
                        'new' => 'New',
                        'used' => 'Used',
                    ])
                    ->required(),
                Forms\Components\Select::make('availability')
                    ->label('Availability')
                    ->options([
                        'in_stock' => 'In Stock',
                        'out_of_stock' => 'Out of Stock',
                        'pre_order' => 'Pre Order',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('currency')
                    ->default('CAD')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('part_number')
                    ->label('Part Number'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->size(50),
            ])
            ->filters([])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
