<?php

namespace App\Filament\Resources\GrupoCategoriaResource\Pages;

use App\Filament\Resources\GrupoCategoriaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateGrupoCategoria extends CreateRecord
{
    protected static string $resource = GrupoCategoriaResource::class;

    // Después de crear, redirige al index (lista)
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Grupo Principal creado')
            ->body('El bloque grande se ha creado correctamente.');
    }
}