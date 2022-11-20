<?php

namespace App\Filament\Widgets;

use App\Models\Classe;
use App\Models\Reservation;
use App\Models\Salle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {

        $sal = Salle::count('*');
        $re = Reservation::count('*');
        $cla = Classe::count('*');
        return [
            Card::make('Salles', $sal)
            ->description('32k increase')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),
        Card::make('Classes', $cla)
            ->description('7% increase')
            ->descriptionIcon('heroicon-s-trending-down')
            ->color('danger'),
        Card::make('Reservation', $re)
            ->description('3% increase')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('success'),
        ];
    }
}
