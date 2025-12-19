<?php

namespace App\Filament\Resources\ProductoResource\Pages;

use App\Filament\Resources\ProductoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListProductos extends ListRecords
{
    protected static string $resource = ProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo Producto')
                ->icon('heroicon-o-plus-circle')
                ->color('success'),
        ];
    }

    // Notificación al eliminar un producto
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->warning()
            ->title('Producto eliminado')
            ->body('El producto se ha quitado del catálogo.');
    }

    // Notificación al eliminar varios
    protected function getDeletedBulkNotification(): ?Notification
    {
        return Notification::make()
            ->warning()
            ->title('Productos eliminados')
            ->body('Los productos seleccionados se han eliminado del catálogo.');
    }
}