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

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntradaLibroMayorResource extends Resource
{
    protected static ?string $model = Entrada_libro_mayor::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Libro Mayor';

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
            TextColumn::make('id_cuentas_contable.name')->label('Cuenta Contable')->sortable(),
            TextColumn::make('balance')->label('Saldo')->money('USD'),
            //TextColumn::make('updated_at')->label('Última Actualización')->sortable(),
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
            'index' => Pages\ListEntradaLibroMayors::route('/'),
            'create' => Pages\CreateEntradaLibroMayor::route('/create'),
            'edit' => Pages\EditEntradaLibroMayor::route('/{record}/edit'),
        ];
    }    
}
