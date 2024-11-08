<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibroDiarioResource\Pages;
use App\Models\LibroDiario;
use App\Models\CuentasContables;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LibroDiarioResource extends Resource
{
    protected static ?string $model = LibroDiario::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Libro Diario';
    protected static ?string $pluralLabel = 'Libros Diarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('fecha')
                    ->label('Fecha')
                    ->required(),

                Forms\Components\Select::make('cuenta_contable_id')
                    ->label('Cuenta Contable')
                    ->options(CuentasContables::all()->pluck('nombre', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->required(),

                Forms\Components\TextInput::make('debe')
                    ->label('Debe')
                    ->numeric()
                    ->required()
                    ->default(0),

                Forms\Components\TextInput::make('haber')
                    ->label('Haber')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->label('Fecha')
                    ->date(),

                Tables\Columns\TextColumn::make('cuentaContable.nombre')
                    ->label('Cuenta Contable'),

                Tables\Columns\TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50),

                Tables\Columns\TextColumn::make('debe')
                    ->label('Debe')
                    ->money('usd',true),

                Tables\Columns\TextColumn::make('haber')
                    ->label('Haber')
                    ->money('usd',true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
