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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class EstadoResultadosResource extends Resource
{
    protected static ?string $model = EstadoResultados::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                ->label('Nombre de la Cuenta')
                ->required(),
            Select::make('tipo')
                ->label('Tipo de Cuenta')
                ->options([
                    'ingreso' => 'Ingreso',
                    'gasto' => 'Gasto',
                ])
                ->required(),
            TextInput::make('monto')
                ->label('Monto')
                ->numeric()
                ->required()
                ->default(0),
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
            'index' => Pages\ListEstadoResultados::route('/'),
            'create' => Pages\CreateEstadoResultados::route('/create'),
            'edit' => Pages\EditEstadoResultados::route('/{record}/edit'),
        ];
    }    
}