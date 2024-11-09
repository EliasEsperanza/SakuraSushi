<?php

namespace App\Filament\Resources\BalanceGeneralResource\Pages;

use App\Filament\Resources\BalanceGeneralResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBalanceGeneral extends EditRecord
{
    protected static string $resource = BalanceGeneralResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
