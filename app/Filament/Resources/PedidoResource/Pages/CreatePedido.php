<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePedido extends CreateRecord
{
    protected static string $resource = PedidoResource::class;

    protected static ?string $title = 'Crear Nuevo Pedido';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Opcional: Generar código automático al crear
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ejemplo: PED-2025-0001
        $year = date('Y');
        $last = \App\Models\Pedido::whereYear('created_at', $year)->count() + 1;
        $data['codigo'] = "PED-{$year}-" . str_pad($last, 4, '0', STR_PAD_LEFT);

        return $data;
    }
}