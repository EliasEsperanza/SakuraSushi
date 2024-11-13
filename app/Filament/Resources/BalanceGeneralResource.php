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
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class BalanceGeneralResource extends Resource
{
    protected static ?string $model = BalanceGeneral::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
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
            TextInput::make('saldo_final')
                ->label('Saldo Final')
                ->numeric()
                ->required()
                ->default(0),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipo')->label('Tipo de Cuenta')->sortable(),
                TextColumn::make('codigo')->label('Código de Cuenta'),
                TextColumn::make('nombre')->label('Nombre de la Cuenta'),
                TextColumn::make('saldo_final')->label('Saldo'),
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
