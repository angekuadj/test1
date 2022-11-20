<?php

namespace App\Filament\Resources\SalleResource\Pages;

use App\Filament\Resources\SalleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalles extends ListRecords
{
    protected static string $resource = SalleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
