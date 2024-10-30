<?php

namespace App\Filament\Resources\CuentasContablesResource\Pages;

use App\Filament\Resources\CuentasContablesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCuentasContables extends ListRecords
{
    protected static string $resource = CuentasContablesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
