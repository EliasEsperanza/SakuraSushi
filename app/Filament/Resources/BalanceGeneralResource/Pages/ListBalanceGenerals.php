<?php

namespace App\Filament\Resources\BalanceGeneralResource\Pages;

use App\Filament\Resources\BalanceGeneralResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBalanceGenerals extends ListRecords
{
    protected static string $resource = BalanceGeneralResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
