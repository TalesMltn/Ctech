<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Categorías';
    protected static ?string $label = 'Categoría';
    protected static ?string $pluralLabel = 'Categorías';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->debounce(500)
                    ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(Categoria::class, 'slug', ignoreRecord: true)
                    ->helperText('Se genera automáticamente, pero puedes editarlo.'),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('icono')
                    ->label('Icono (Heroicon o clase CSS)')
                    ->placeholder('Ej: heroicon-o-tag')
                    ->maxLength(255),

                // AQUÍ ESTÁ EL TOGGLE QUE QUERÍAS
                Forms\Components\Toggle::make('oculta')
                    ->label('¿Ocultar categoría?')
                    ->helperText('Si activas este interruptor, la categoría NO aparecerá en la tienda ni en menús.')
                    ->default(false)                    // false = visible por defecto
                    ->onIcon('heroicon-m-eye-slash')    // cuando está oculto
                    ->offIcon('heroicon-m-eye')         // cuando está visible
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
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('icono')
                    ->label('Icono')
                    ->formatStateUsing(fn (?string $state) => $state ? "✓ {$state}" : '—'),

                // Columna para ver rápido si está oculta o no
                Tables\Columns\ToggleColumn::make('oculta')
                    ->label('Oculta')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filtro rápido para ver solo visibles u ocultas
                Tables\Filters\TernaryFilter::make('oculta')
                    ->label('Visibilidad')
                    ->placeholder('Todas')
                    ->trueLabel('Ocultas')
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
            ])
            ->defaultSort('nombre', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit'   => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}