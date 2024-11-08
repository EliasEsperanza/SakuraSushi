<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LedgerEntryResource\Pages;
use App\Filament\Resources\LedgerEntryResource\RelationManagers;
use App\Models\LedgerEntry;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LedgerEntryResource extends Resource
{
    protected static ?string $model = LedgerEntry::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('cuentas_contable.name')->label('Cuenta Contable')->sortable(),
            TextColumn::make('balance')->label('Saldo')->money('USD'),
            TextColumn::make('updated_at')->label('Última Actualización')->sortable(),
        ])
        ->filters([
            // Agrega filtros si es necesario
        ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLedgerEntries::route('/'),
            'create' => Pages\CreateLedgerEntry::route('/create'),
            'edit' => Pages\EditLedgerEntry::route('/{record}/edit'),
        ];
    }    
}
