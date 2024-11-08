<?php

namespace App\Filament\Resources\EntradaLibroMayorResource\Pages;

use App\Filament\Resources\EntradaLibroMayorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntradaLibroMayor extends EditRecord
{
    protected static string $resource = EntradaLibroMayorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
