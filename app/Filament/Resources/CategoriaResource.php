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

                Forms\Components\Select::make('grupo')
                    ->label('Grupo Principal')
                    ->options([
                        'laptops'     => 'Laptops',
                        'pcs'         => 'PC de Escritorio',
                        'perifericos' => 'Periféricos Gaming',
                        'accesorios'  => 'Accesorios',
                        'monitores'   => 'Monitores y Pantallas',
                        'otros'       => 'Otros',
                    ])
                    ->required()
                    ->default('otros')
                    ->helperText('Elige el bloque grande donde aparecerá esta categoría en la página principal.'),

                Forms\Components\TextInput::make('orden')
                    ->label('Orden de aparición')
                    ->numeric()
                    ->default(0)
                    ->helperText('Número más alto = aparece primero dentro de su grupo. Ej: 100 = primero.'),

                Forms\Components\FileUpload::make('imagen')
                    ->label('Imagen para el grupo')
                    ->image()
                    ->directory('categorias')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->helperText('Se usará como imagen del bloque grande si esta categoría tiene el mayor orden en su grupo.')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('icono')
                    ->label('Icono (Emoji o Heroicon)')
                    ->placeholder('Ej: 💻 o heroicon-o-computer-desktop')
                    ->maxLength(255),

                Forms\Components\Toggle::make('oculta')
                    ->label('¿Ocultar categoría?')
                    ->helperText('Si activas este interruptor, la categoría NO aparecerá en la tienda ni en menús.')
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

                Tables\Columns\TextColumn::make('grupo')
                    ->label('Grupo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'laptops'     => 'info',
                        'pcs'         => 'warning',
                        'perifericos' => 'success',
                        'accesorios'  => 'gray',
                        'monitores'   => 'primary',
                        'otros'       => 'secondary',
                        default       => 'secondary',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->size(50)
                    ->circular(),

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
                Tables\Filters\SelectFilter::make('grupo')
                    ->label('Grupo')
                    ->options([
                        'laptops'     => 'Laptops',
                        'pcs'         => 'PC de Escritorio',
                        'perifericos' => 'Periféricos Gaming',
                        'accesorios'  => 'Accesorios',
                        'monitores'   => 'Monitores y Pantallas',
                        'otros'       => 'Otros',
                    ]),

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
            ->defaultSort('grupo', 'asc')
            ->reorderable('orden'); // Permite arrastrar para reordenar en la tabla
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