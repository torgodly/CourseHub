<?php

namespace App\Filament\Trainer\Resources\WalletResource\Widgets;

use App\Models\Course;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WalletOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $courses = Course::where('trainer_id', auth()->user()->id)->with('wallet')->get();
        $totalWithdrawn = $courses->sum(function ($course) {
            return $course->wallet->balance;
        });


        return [
            //user wallet balance
            Stat::make(__('Balance'), auth()->user()->wallet->balance . 'د.ل')
                ->icon('tabler-wallet')
                ->color('success')
                ->description(__('Your current wallet balance.')),

            //available balance can be withdrawn from user courses

            Stat::make(__('Available Balance'), $totalWithdrawn . 'د.ل')
                ->icon('tabler-wallet')
                ->color('primary')
                ->description(__('Your available balance for withdrawal.')),
        ];
    }
}
