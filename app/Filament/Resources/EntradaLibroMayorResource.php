<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntradaLibroMayorResource\Pages;
use App\Filament\Resources\EntradaLibroMayorResource\RelationManagers;
use App\Models\Entrada_libro_mayor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntradaLibroMayorResource extends Resource
{
    protected static ?string $model = Entrada_libro_mayor::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    //protected static ?string $navigationLabel = 'Libro Mayor';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*TextInput::make('id_cuentas_contable')->required(),
                TextInput::make('balance')->required()->maxLength(100)*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id_cuentas_contables')->label('Id Cuenta Contable')->sortable(),
            TextColumn::make('cuenta_contable_nombre')->label('Nombre Cuenta'),
            TextColumn::make('monto')->label('Saldo')->money('usd',true),
            //TextColumn::make('updated_at')->label('Última Actualización')->sortable(),
        ])
        ->filters([
            // Agrega filtros si es necesario
        ])
        /*->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ])*/;
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
            'index' => Pages\ListEntradaLibroMayors::route('/'),
            'create' => Pages\CreateEntradaLibroMayor::route('/create'),
            'edit' => Pages\EditEntradaLibroMayor::route('/{record}/edit'),
        ];
    }    
}
