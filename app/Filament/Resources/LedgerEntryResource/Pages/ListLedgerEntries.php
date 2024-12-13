<?php

namespace App\Filament\Resources\LedgerEntryResource\Pages;

use App\Filament\Resources\LedgerEntryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLedgerEntries extends ListRecords
{
    protected static string $resource = LedgerEntryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
