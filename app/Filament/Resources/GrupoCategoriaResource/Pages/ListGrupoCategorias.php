<?php

namespace App\Filament\Resources\GrupoCategoriaResource\Pages;

use App\Filament\Resources\GrupoCategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGrupoCategorias extends ListRecords
{
    protected static string $resource = GrupoCategoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
