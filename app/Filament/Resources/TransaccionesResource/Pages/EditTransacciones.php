<?php

namespace App\Filament\Resources\TransaccionesResource\Pages;

use App\Filament\Resources\TransaccionesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransacciones extends EditRecord
{
    protected static string $resource = TransaccionesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
