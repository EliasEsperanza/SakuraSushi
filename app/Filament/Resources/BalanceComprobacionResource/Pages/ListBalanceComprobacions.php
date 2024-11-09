<?php

namespace App\Filament\Resources\BalanceComprobacionResource\Pages;

use App\Filament\Resources\BalanceComprobacionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBalanceComprobacions extends ListRecords
{
    protected static string $resource = BalanceComprobacionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
