<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BoardingHouse;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BoardingHouseResource\Pages;
use App\Filament\Resources\BoardingHouseResource\RelationManagers;
use App\Filament\Resources\BoardingHouseResource\RelationManagers\NearestPlacesRelationManager;
use App\Filament\Resources\BoardingHouseResource\RelationManagers\RulesRelationManager;
use Filament\Forms\Components\Fieldset;

class BoardingHouseResource extends Resource
{
    protected static ?string $model = BoardingHouse::class;

    protected static ?string $navigationGroup = 'Boarding House Management';

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('General Information')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\FileUpload::make('thumbnail')
                                ->image()
                                ->directory('boardingHouse')
                                ->required(),
                            Forms\Components\Select::make('city_id')
                                ->relationship('city', 'name')
                                ->required(),
                            Forms\Components\Select::make('category_id')
                                ->relationship('category', 'name')
                                ->required(),
                            Forms\Components\RichEditor::make('description')
                                ->required(),
                            Forms\Components\TextInput::make('price')
                                ->numeric()
                                ->prefix('IDR')
                                ->required(),
                            Forms\Components\Textarea::make('address')
                                ->required(),
                        ]),
                    Tabs\Tab::make('Bonuses & Facilities')
                        ->schema([
                            Fieldset::make('Facilities')
                                ->schema([
                                    Forms\Components\Select::make('facilities')
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->relationship('facilities', 'name')
                                    ->required(),
                                ]),
                            Repeater::make('bonuses')
                                ->relationship('bonuses')
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\FileUpload::make('image')
                                        ->image()
                                        ->directory('bonusImage')
                                        ->required(),
                                    Forms\Components\Textarea::make('description')
                                        ->required(),
                                ]),
                        ]),
                    Tabs\Tab::make('Room Choice')
                        ->schema([
                            Repeater::make('rooms')
                                ->relationship('rooms')
                                ->schema([
                                    Repeater::make('images')
                                        ->relationship('images')
                                        ->schema([
                                            Forms\Components\FileUpload::make('image')
                                                ->image()
                                                ->directory('roomsImage')
                                                ->required(),
                                        ]),
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('room_type')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('square_feet')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\TextInput::make('capacity')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\TextInput::make('price_per_month')
                                        ->numeric()
                                        ->prefix('IDR')
                                        ->required(),
                                    Forms\Components\Toggle::make('is_available')
                                        ->required(),
                                ]),
                        ]),
                    Tabs\Tab::make('Contact Owner')
                        ->schema([
                            Repeater::make('contacts')
                                ->relationship('contacts')
                                ->schema([
                            Forms\Components\FileUpload::make('avatar')
                                ->image()
                                ->directory('contactAvatar')
                                ->required(),
                            Forms\Components\TextInput::make('name')
                                ->label('Owner Name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('phone')
                                ->label('Phone Number')
                                ->tel()
                                ->required(),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                                ]),
                        ]),
                ])->columnSpanFull()
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nama')
                ->searchable(),
            Tables\Columns\ImageColumn::make('thumbnail')
                ->label('Thumbnail')
                ->disk('public'),
            Tables\Columns\TextColumn::make('city.name')
                ->label('Kota')
                ->searchable(),
            Tables\Columns\TextColumn::make('category.name')
                ->label('Kategori')
                ->searchable(),
            Tables\Columns\TextColumn::make('bonuses_count')
                ->label('Bonus')
                ->counts('bonuses')
                ->sortable(),
            Tables\Columns\TextColumn::make('rooms_count')
                ->label('Kamar')
                ->counts('rooms')
                ->sortable(),
            Tables\Columns\TextColumn::make('price')
                ->label('Harga')
                ->money('IDR', true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city_id')
                ->label('Kota')
                ->relationship('city', 'name')
                ->searchable(),

            Tables\Filters\SelectFilter::make('category_id')
                ->label('Kategori')
                ->relationship('category', 'name')
                ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([
                'items_per_page_options' => [10, 25, 50, 100],
                'default_items_per_page' => 10,
            ])
            ->paginationPageOptions([10, 25, 50, 100]);;
    }

    public static function getRelations(): array
    {
        return [
            RulesRelationManager::class,
            NearestPlacesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBoardingHouses::route('/'),
            'create' => Pages\CreateBoardingHouse::route('/create'),
            'edit' => Pages\EditBoardingHouse::route('/{record}/edit'),
        ];
    }
}
