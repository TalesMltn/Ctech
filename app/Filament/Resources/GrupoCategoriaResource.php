<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GrupoCategoriaResource\Pages;
use App\Models\GrupoCategoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GrupoCategoriaResource extends Resource
{
    protected static ?string $model = GrupoCategoria::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder-open';
    protected static ?string $navigationLabel = 'Grupos Principales';
    protected static ?string $label = 'Grupo Principal';
    protected static ?string $pluralLabel = 'Grupos Principales';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre del bloque grande')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->debounce(500)
                    ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(GrupoCategoria::class, 'slug', ignoreRecord: true)
                    ->helperText('Se genera automáticamente'),

                Forms\Components\FileUpload::make('imagen')
                    ->label('Imagen del bloque (home)')
                    ->image()
                    ->directory('grupos')
                    ->visibility('public')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->helperText('Imagen grande que aparecerá como fondo del bloque en la página principal (recomendado: 1200x800px)')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('icono')
                    ->label('Icono (emoji o Heroicon)')
                    ->placeholder('Ej: 💻 o heroicon-o-cpu-chip')
                    ->maxLength(255)
                    ->helperText('Icono que aparecerá encima del nombre del bloque en la home'),

                Forms\Components\TextInput::make('orden')
                    ->label('Orden en la home')
                    ->numeric()
                    ->default(0)
                    ->helperText('Número más alto = aparece más a la izquierda. Los primeros 4-6 estarán en la fila superior, el resto debajo.'),

                // NUEVO: TOGGLE PARA OCULTAR EL GRUPO ENTERO
                Forms\Components\Toggle::make('oculta')
                    ->label('¿Ocultar este grupo principal?')
                    ->helperText('Si activas este interruptor, el bloque completo (y todas sus subcategorías) NO aparecerá en la página principal.')
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
                    ->label('Nombre del Grupo')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable(),

                    Tables\Columns\ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->getStateUsing(fn ($record) => $record->imagen ? asset('storage/' . $record->imagen) : null)
                    ->size(80)
                    ->circular(),

                Tables\Columns\TextColumn::make('icono')
                    ->label('Icono')
                    ->formatStateUsing(fn (?string $state) => $state ? $state : '—'),

                Tables\Columns\TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable()
                    ->badge(),

                // NUEVO: COLUMNA PARA VER SI ESTÁ OCULTO
                Tables\Columns\ToggleColumn::make('oculta')
                    ->label('Oculta')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('oculta')
                    ->label('Visibilidad')
                    ->placeholder('Todas')
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
            ])
            ->defaultSort('orden', 'desc')
            ->reorderable('orden');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGrupoCategorias::route('/'),
            'create' => Pages\CreateGrupoCategoria::route('/create'),
            'edit'   => Pages\EditGrupoCategoria::route('/{record}/edit'),
        ];
    }
}