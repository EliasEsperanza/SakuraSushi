<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibroDiarioResource\Pages;
use App\Filament\Resources\LibroDiarioResource\RelationManagers;
use App\Models\LibroDiario;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use App\Models\CuentasContables;
use App\Models\Transacciones;

class LibroDiarioResource extends Resource
{
    protected static ?string $model = LibroDiario::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha')->date()->sortable(),
                TextColumn::make('cuentaContable.nombre')->label('Cuenta Contable')->sortable(),
                TextColumn::make('transaccion.descripcion')->label('Transacción')->sortable(),
                TextColumn::make('debe')->money('usd', true),
                TextColumn::make('haber')->money('usd', true),
                TextColumn::make('saldo')->money('usd', true),
            ])
            ->filters([
                
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
            'index' => Pages\ListLibroDiarios::route('/'),
            'create' => Pages\CreateLibroDiario::route('/create'),
            'edit' => Pages\EditLibroDiario::route('/{record}/edit'),
        ];
    }    
}
