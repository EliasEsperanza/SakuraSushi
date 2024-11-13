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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;

class BalanceComprobacionResource extends Resource
{
    protected static ?string $model = BalanceComprobacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([/*
            Select::make('id_cuenta_contable')
                ->label('Cuenta Contable')
                ->relationship('cuentaContable', 'nombre')
                ->required(),
            TextInput::make('codigo')
                ->label('Código de Cuenta')
                ->required(),
            TextInput::make('nombre')
                ->label('Nombre de la Cuenta')
                ->required(),
            TextInput::make('tipo')
                ->label('Tipo de Cuenta')
                ->required(),
            TextInput::make('saldo_debe')
                ->label('Saldo Debe')
                ->numeric()
                ->required()
                ->default(0),
            TextInput::make('saldo_haber')
                ->label('Saldo Haber')
                ->numeric()
                ->required()
                ->default(0),*/
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
                TextColumn::make('balanceado')->label('Esta balanceado?')
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
