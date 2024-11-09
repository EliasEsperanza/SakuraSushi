<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalanceGeneralResource\Pages;
use App\Filament\Resources\BalanceGeneralResource\RelationManagers;
use App\Models\BalanceGeneral;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\CuentasContables;
use Filament\Tables\Columns\TextColumn;

class BalanceGeneralResource extends Resource
{
 

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
                TextColumn::make('tipo')->label('Tipo de Cuenta')->sortable(),
                TextColumn::make('codigo')->label('Código de Cuenta'),
                TextColumn::make('nombre')->label('Nombre de la Cuenta'),
                TextColumn::make('saldo')->label('Saldo'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBalanceGenerals::route('/'),
            'create' => Pages\CreateBalanceGeneral::route('/create'),
            'edit' => Pages\EditBalanceGeneral::route('/{record}/edit'),
        ];
    }    
}
