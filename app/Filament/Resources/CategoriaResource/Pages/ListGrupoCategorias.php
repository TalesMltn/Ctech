<?php

namespace App\Filament\Resources\GrupoCategoriaResource\Pages;

use App\Filament\Resources\GrupoCategoriaResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;

class ListGrupoCategorias extends ListRecords
{
    protected static string $resource = GrupoCategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Nuevo Grupo Principal')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    // Opcional: mensaje al eliminar
    protected function getDeletedNotification(): ?Notification
    {
        return Notification::make()
            ->warning()
            ->title('Grupo Principal eliminado')
            ->body('El bloque grande se ha eliminado de la página principal.');
    }
}