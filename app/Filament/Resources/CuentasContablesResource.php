<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CuentasContablesResource\Pages;
use App\Filament\Resources\CuentasContablesResource\RelationManagers;
use App\Models\CuentasContables;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;


class CuentasContablesResource extends Resource
{
    protected static ?string $model = CuentasContables::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('codigo')->required()->maxLength(4),
                TextInput::make('nombre')->required()->maxLength(100),
                TextInput::make('tipo')->required()->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo')->sortable()->searchable(),
                TextColumn::make('nombre')->sortable()->searchable(),
                TextColumn::make('tipo')->sortable(),
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
            'index' => Pages\ListCuentasContables::route('/'),
            'create' => Pages\CreateCuentasContables::route('/create'),
            'edit' => Pages\EditCuentasContables::route('/{record}/edit'),
        ];
    }    
}
