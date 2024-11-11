<?php

namespace App\Filament\Resources\BalanceComprobacionResource\Pages;

use App\Filament\Resources\BalanceComprobacionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBalanceComprobacion extends EditRecord
{
    protected static string $resource = BalanceComprobacionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
