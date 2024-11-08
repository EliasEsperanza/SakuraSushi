<?php

namespace App\Filament\Resources\LedgerEntryResource\Pages;

use App\Filament\Resources\LedgerEntryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLedgerEntry extends EditRecord
{
    protected static string $resource = LedgerEntryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
