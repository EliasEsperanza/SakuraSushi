<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaccionesResource\Pages;
use App\Filament\Resources\TransaccionesResource\RelationManagers;
use App\Models\Transacciones;
use App\Filament\Resources\TransaccionesResource\Pages\ListTransacciones;
use App\Filament\Resources\TransaccionesResource\Pages\CreateTransacciones;
use App\Filament\Resources\TransaccionesResource\Pages\EditTransacciones;
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


class TransaccionesResource extends Resource
{
    protected static ?string $model = Transacciones::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_cuenta_contable')
                    ->relationship('cuentaContable', 'nombre')
                    ->required(),
                DatePicker::make('fecha')->required(),
                Textarea::make('descripcion')->required()->maxLength(255),
                TextInput::make('monto')->numeric()->required(),
                TextInput::make('tipo_movimiento')->required()->maxLength(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cuentaContable.nombre')->label('Cuenta Contable')->sortable(),
                TextColumn::make('fecha')->date()->sortable(),
                TextColumn::make('descripcion')->limit(50),
                TextColumn::make('monto')->money('usd', true),
                TextColumn::make('tipo_movimiento')->sortable(),
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
            'index' => Pages\ListTransacciones::route('/'),
            'create' => Pages\CreateTransacciones::route('/create'),
            'edit' => Pages\EditTransacciones::route('/{record}/edit'),
        ];
    }    
}
