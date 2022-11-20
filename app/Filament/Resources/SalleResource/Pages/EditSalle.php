<?php

namespace App\Filament\Resources\SalleResource\Pages;

use App\Filament\Resources\SalleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalle extends EditRecord
{
    protected static string $resource = SalleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
