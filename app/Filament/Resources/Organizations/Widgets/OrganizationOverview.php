<?php

namespace App\Filament\Resources\Organizations\Widgets;

use App\Models\Branch;
use App\Models\Organization;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrganizationOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Branches', Branch::count())
                ->icon('heroicon-m-building-office-2')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
            Stat::make('Team Members', User::count())
                ->icon('heroicon-m-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
            Stat::make('Patients', Organization::count())
                ->icon('heroicon-m-user-plus')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
            // Stat::make('Payments', Organization::count())
            //     ->icon('heroicon-m-credit-card')
            //     ->chart([7, 2, 10, 3, 15, 4, 17])
            //     ->color('info'),

        ];
    }
}
