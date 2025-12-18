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
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Subcategorías';
    protected static ?string $label = 'Subcategoría';
    protected static ?string $pluralLabel = 'Subcategorías';
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

                Forms\Components\Select::make('grupo_categoria_id')
                    ->label('Pertenece al grupo')
                    ->relationship('grupoCategoria', 'nombre')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Elige el bloque grande donde aparecerá esta subcategoría en la página principal.'),

                Forms\Components\TextInput::make('orden')
                    ->label('Orden de aparición')
                    ->numeric()
                    ->default(0)
                    ->helperText('Número más alto = aparece primero dentro de su grupo. Ej: 100 = primero.'),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('icono')
                    ->label('Icono (Emoji o Heroicon)')
                    ->placeholder('Ej: 💻 o heroicon-o-computer-desktop')
                    ->maxLength(255),

                Forms\Components\Toggle::make('oculta')
                    ->label('¿Ocultar subcategoría?')
                    ->helperText('Si activas este interruptor, la subcategoría NO aparecerá en la tienda ni en menús.')
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
                Tables\Columns\TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('grupoCategoria.nombre')
                    ->label('Grupo Principal')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                Tables\Columns\TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('icono')
                    ->label('Icono')
                    ->formatStateUsing(fn (?string $state) => $state ? $state : '—'),

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
                Tables\Filters\SelectFilter::make('grupo_categoria_id')
                    ->label('Grupo Principal')
                    ->relationship('grupoCategoria', 'nombre'),

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
            ->defaultSort('grupo_categoria_id', 'asc')
            ->reorderable('orden');
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