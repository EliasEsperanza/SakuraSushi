<?php

namespace App\Filament\Resources\CuentasContablesResource\Pages;

use App\Filament\Resources\CuentasContablesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCuentasContables extends EditRecord
{
    protected static string $resource = CuentasContablesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
