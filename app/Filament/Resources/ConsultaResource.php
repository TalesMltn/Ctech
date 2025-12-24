<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultaResource\Pages;
use App\Models\Consulta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationLabel = 'Consultas';

    protected static ?string $pluralLabel = 'Consultas de Clientes';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Contacto'; // Opcional: agrupa con Pedidos

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('correo')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('motivo')
                    ->label('Motivo de la Consulta')
                    ->options([
                        'consulta_general' => 'Consulta General',
                        'soporte_tecnico'   => 'Soporte Técnico',
                        'cotizacion'        => 'Cotización',
                        'reclamo'           => 'Reclamo o Queja',
                        'otro'              => 'Otro',
                    ])
                    ->default('consulta_general'),

                Forms\Components\Textarea::make('mensaje')
                    ->label('Mensaje Detallado')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('leida')
                    ->label('¿Marcar como leída?')
                    ->default(false)
                    ->inline(false),
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

                Tables\Columns\TextColumn::make('correo')
                    ->label('Correo')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Correo copiado'),

                Tables\Columns\TextColumn::make('motivo')
                    ->label('Motivo')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'consulta_general' => 'Consulta General',
                        'soporte_tecnico'   => 'Soporte Técnico',
                        'cotizacion'        => 'Cotización',
                        'reclamo'           => 'Reclamo',
                        'otro'              => 'Otro',
                        default            => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'reclamo' => 'danger',
                        'cotizacion' => 'warning',
                        default => 'primary',
                    }),

                Tables\Columns\TextColumn::make('mensaje')
                    ->label('Mensaje')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->mensaje),

                Tables\Columns\IconColumn::make('leida')
                    ->label('Leída')
                    ->boolean()
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('leida')
                    ->label('Estado de lectura')
                    ->placeholder('Todas')
                    ->trueLabel('Leídas')
                    ->falseLabel('No leídas'),
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
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListConsultas::route('/'),
            'create' => Pages\CreateConsulta::route('/create'),
            'edit'   => Pages\EditConsulta::route('/{record}/edit'),
        ];
    }
}