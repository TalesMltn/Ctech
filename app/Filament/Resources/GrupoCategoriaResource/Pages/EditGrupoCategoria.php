<?php

namespace App\Filament\Resources\GrupoCategoriaResource\Pages;

use App\Filament\Resources\GrupoCategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGrupoCategoria extends EditRecord
{
    protected static string $resource = GrupoCategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
