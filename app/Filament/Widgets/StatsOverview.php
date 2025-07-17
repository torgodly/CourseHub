<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي الطلاب', \App\Models\User::where('type', 'user')->count())
                ->color('primary')
                ->icon('heroicon-o-users')
                ->chart(['100', '250', '180', '320', '270', '400', '350']),

            Stat::make('إجمالي المدربين', \App\Models\User::where('type', 'trainer')->count())
                ->color('info')
                ->icon('heroicon-o-user-group')
                ->chart(['150', '140', '160', '200', '190', '210', '180']),

            Stat::make('إجمالي الدورات', \App\Models\Course::count())
                ->color('success')
                ->icon('heroicon-o-book-open')
                ->chart(['90', '130', '110', '170', '150', '180', '160']),

            Stat::make('إجمالي التسجيلات', \App\Models\Enrollment::count())
                ->color('warning')
                ->icon('heroicon-o-check-circle')
                ->chart(['200', '240', '220', '260', '250', '280', '270']),
        ]
            ;
    }
}
