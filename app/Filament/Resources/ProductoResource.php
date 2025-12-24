<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Productos';

    protected static ?string $label = 'Producto';

    protected static ?string $pluralLabel = 'Productos';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Elige la categoría principal para este producto.'),

                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->maxLength(255)
                    ->unique(Producto::class, 'slug', ignoreRecord: true)
                    ->dehydrated()
                    ->helperText('Se genera automáticamente del nombre. Puedes editarlo si quieres.'),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('precio')
                    ->label('Precio')
                    ->required()
                    ->numeric()
                    ->prefix('S/.')
                    ->helperText('Precio en soles peruanos.'),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->numeric()
                    ->default(10)
                    ->helperText('Cantidad disponible en inventario.'),

                Forms\Components\FileUpload::make('imagen')
                    ->label('Imagen del Producto')
                    ->image()
                    ->directory('productos')
                    ->imageEditor()
                    ->imagePreviewHeight('200')
                    ->nullable()
                    ->helperText('Sube una imagen JPG/PNG. Se optimizará automáticamente.'),

                Forms\Components\Toggle::make('destacado')
                    ->label('¿Destacado / En Oferta?')
                    ->helperText('Si activas, aparecerá en la sección de ofertas en la página principal.')
                    ->default(false)
                    ->onIcon('heroicon-m-star')
                    ->offIcon('heroicon-o-star')
                    ->onColor('success')
                    ->offColor('danger')
                    ->inline(false),

                Forms\Components\Toggle::make('oculta')
                    ->label('¿Ocultar Producto?')
                    ->helperText('Si activas, el producto NO aparecerá en la tienda.')
                    ->default(false)
                    ->onIcon('heroicon-m-eye-slash')
                    ->offIcon('heroicon-m-eye')
                    ->onColor('danger')
                    ->offColor('success')
                    ->inline(false)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->getStateUsing(fn ($record) => $record->imagen ? asset('storage/' . $record->imagen) : asset('images/placeholder-producto.jpg'))
                    ->size(80)
                    ->circular(false)
                    ->defaultImageUrl(asset('images/placeholder-producto.jpg')),

                Tables\Columns\TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('precio')
                    ->label('Precio')
                    ->money('PEN')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('destacado')
                    ->label('Destacado'),

                Tables\Columns\ToggleColumn::make('oculta')
                    ->label('Oculto'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categoria_id')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre'),

                Tables\Filters\TernaryFilter::make('destacado')
                    ->label('Destacado'),

                Tables\Filters\TernaryFilter::make('oculta')
                    ->label('Visibilidad')
                    ->placeholder('Todos')
                    ->trueLabel('Ocultos')
                    ->falseLabel('Visibles'),
            ])
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}