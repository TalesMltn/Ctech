<?php

namespace App\Filament\Resources\GrupoCategoriaResource\Pages;

use App\Filament\Resources\GrupoCategoriaResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditGrupoCategoria extends EditRecord
{
    protected static string $resource = GrupoCategoriaResource::class;

    // Después de guardar cambios, redirige al listado
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Mensaje bonito al editar
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Grupo Principal actualizado')
            ->body('Los cambios se han guardado y ya se reflejan en la página principal.');
    }
}