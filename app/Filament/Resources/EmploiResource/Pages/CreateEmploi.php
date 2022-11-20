<?php

namespace App\Filament\Resources\EmploiResource\Pages;

use App\Filament\Resources\EmploiResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmploi extends CreateRecord
{
    protected static string $resource = EmploiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['User_id'] = auth()->id();
        return $data;
    }

}
