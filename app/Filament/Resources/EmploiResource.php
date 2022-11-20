<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmploiResource\Pages;
use App\Filament\Resources\EmploiResource\RelationManagers;
use App\Models\Classe;
use App\Models\Emploi;
use App\Models\Prof;
use App\Models\Salle;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmploiResource extends Resource
{
    protected static ?string $model = Emploi::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Repeater::make('emploi')
               ->schema([
                Group::make()
                ->schema([
                    Select::make('classe_id')
        ->label('Classe')
        ->options(
            Classe::all()->pluck('nom', 'id'))
            ->columnSpanFull()
        ->searchable()->required(),
    ]),
Card::make()
    ->schema([
        dateTimePicker::make('Ddebut')
    ->label('Date Debut')
    ->minDate(now()->subYear(0))->required(),
    DateTimePicker::make('Dfin')
    ->label('Date Fin')
    ->minDate(now()->subYear(0))->required(),
    Select::make('salle_id')
->label('Salle')
->options(
Salle::all()->pluck('nom', 'id'))
->searchable()->required(),

Select::make('prof_id')
->label('Professeur')
->options(
Prof::all()->pluck('nom', 'id'))
->searchable()->required(),
    ])
               ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('salle.nom'),
                Tables\Columns\TextColumn::make('classe.id'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('prof.name'),
                Tables\Columns\TextColumn::make('Ddebut')->label('Date Debut'),
                Tables\Columns\TextColumn::make('Dfin')->label('Date Fin'),
                TextColumn::make('salle.nom'or'classe.name')->searchable()
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
            'index' => Pages\ListEmplois::route('/'),
            'create' => Pages\CreateEmploi::route('/create'),
            'edit' => Pages\EditEmploi::route('/{record}/edit'),
        ];
    }    
}