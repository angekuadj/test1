<?php

namespace App\Filament\Resources\EmploiResource\Pages;

use App\Filament\Resources\EmploiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploi extends EditRecord
{
    protected static string $resource = EmploiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
