<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstadoResultadosResource\Pages;
use App\Filament\Resources\EstadoResultadosResource\RelationManagers;
use App\Models\EstadoResultados;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use App\Models\CuentasContables;

class EstadoResultadosResource extends Resource
{
    protected static ?string $model = EstadoResultados::class;

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
                TextColumn::make('nombre')->label('Cuenta'),
                TextColumn::make('tipo')->label('Tipo')->sortable(),
                TextColumn::make('monto')->label('Monto'),
            ])
            ->rows(static::getEstadoResultadosData())
            
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
    
    protected static function getEstadoResultadosData()
    {
        // Llama a la función que devuelve los datos calculados para el estado de resultados
        return EstadoResultados::obtenerResultados();
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
            'index' => Pages\ListEstadoResultados::route('/'),
            'create' => Pages\CreateEstadoResultados::route('/create'),
            'edit' => Pages\EditEstadoResultados::route('/{record}/edit'),
        ];
    }    
}
