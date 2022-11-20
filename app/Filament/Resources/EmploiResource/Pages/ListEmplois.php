<?php

namespace App\Filament\Resources\EmploiResource\Pages;

use App\Filament\Resources\EmploiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmplois extends ListRecords
{
    protected static string $resource = EmploiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
