<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateProducto extends CreateRecord
{
    protected static string $resource = ProductoResource::class;

    // Después de crear, redirige al index (lista)
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Producto creado')
            ->body('El producto se ha agregado correctamente al catálogo.');
    }
}