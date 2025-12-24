<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationLabel = 'Pedidos';

    protected static ?string $pluralLabel = 'Pedidos y Ventas';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Ventas'; // Agrupa con Consultas

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('tipo')
                    ->label('Tipo de Venta')
                    ->options([
                        'online' => 'Online (Web)',
                        'presencial' => 'Presencial (Tienda)',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('codigo')
                    ->label('Código del Pedido')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->placeholder('Ej: PED-2025-0001'),

                Forms\Components\TextInput::make('cliente_nombre')
                    ->label('Nombre del Cliente')
                    ->required(),

                Forms\Components\TextInput::make('cliente_correo')
                    ->label('Correo')
                    ->email(),

                Forms\Components\TextInput::make('cliente_telefono')
                    ->label('Teléfono'),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->prefix('S/.')
                    ->required(),

                Forms\Components\Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'pagado' => 'Pagado',
                        'enviado' => 'Enviado',
                        'entregado' => 'Entregado',
                        'anulado' => 'Anulado',
                    ])
                    ->default('pendiente')
                    ->required(),

                Forms\Components\Textarea::make('notas')
                    ->label('Notas')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('tipo')
                    ->label('Tipo')
                    ->colors([
                        'online' => 'primary',
                        'presencial' => 'success',
                    ])
                    ->formatStateUsing(fn ($state) => $state === 'online' ? 'Online' : 'Presencial'),

                Tables\Columns\TextColumn::make('cliente_nombre')
                    ->label('Cliente')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('PEN'),

                Tables\Columns\BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'pendiente' => 'warning',
                        'pagado' => 'success',
                        'enviado' => 'info',
                        'entregado' => 'success',
                        'anulado' => 'danger',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipo')->label('Tipo de Venta'),
                Tables\Filters\SelectFilter::make('estado'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}