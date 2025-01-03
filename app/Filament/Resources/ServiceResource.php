<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Services';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Service Name')
                    ->required()
                    ->maxLength(40),
                Forms\Components\FileUpload::make('image')
                    ->label('Image')
                    ->directory('uploads/services_images') // Directory where images will be stored
                    ->image()
                    ->nullable(),
                Forms\Components\Toggle::make('status')
                    ->label('Status')
                    ->default(true),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),
                Forms\Components\TextInput::make('service_type')
                    ->label('Service Type')
                    ->required()
                    ->maxLength(40),
                Forms\Components\KeyValue::make('specifications')
                    ->label('Specifications')
                    ->keyLabel('Key')
                    ->valueLabel('Value')
                    ->required(),
                Forms\Components\KeyValue::make('technical_information')
                    ->label('Technical Information')
                    ->keyLabel('Key')
                    ->valueLabel('Value')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('service_type')
                    ->label('Service Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
