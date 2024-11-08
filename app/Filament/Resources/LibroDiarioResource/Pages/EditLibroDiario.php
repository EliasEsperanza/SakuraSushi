<?php

namespace App\Filament\Resources\LibroDiarioResource\Pages;

use App\Filament\Resources\LibroDiarioResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLibroDiario extends EditRecord
{
    protected static string $resource = LibroDiarioResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
