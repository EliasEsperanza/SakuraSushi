<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BalanceComprobacionResource\Pages;
use App\Filament\Resources\BalanceComprobacionResource\RelationManagers;
use App\Models\BalanceComprobacion;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class BalanceComprobacionResource extends Resource
{
    protected static ?string $model = BalanceComprobacion::class;

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
                TextColumn::make('codigo')->label('Código de Cuenta'),
                TextColumn::make('nombre')->label('Nombre de la Cuenta'),
                TextColumn::make('tipo')->label('Tipo de Cuenta'),
                TextColumn::make('saldo_debe')->label('Saldo en Debe'),
                TextColumn::make('saldo_haber')->label('Saldo en Haber'),
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
            'index' => Pages\ListBalanceComprobacions::route('/'),
            'create' => Pages\CreateBalanceComprobacion::route('/create'),
            'edit' => Pages\EditBalanceComprobacion::route('/{record}/edit'),
        ];
    }    
}
