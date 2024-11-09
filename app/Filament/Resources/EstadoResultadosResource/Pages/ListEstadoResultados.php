<?php

namespace App\Filament\Resources\EstadoResultadosResource\Pages;

use App\Filament\Resources\EstadoResultadosResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstadoResultados extends ListRecords
{
    protected static string $resource = EstadoResultadosResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
