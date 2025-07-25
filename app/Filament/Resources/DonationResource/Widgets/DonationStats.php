<?php

namespace App\Filament\Resources\DonationResource\Widgets;

use App\Models\Donation;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DonationStats extends BaseWidget
{
    protected function getStats(): array
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $previousMonth = Carbon::now()->subMonth();


        $countThisYear = Donation::whereYear('created_at','=', $currentYear)->where('status', 'Completed')->count();
        $countThisMonth = Donation::whereYear('created_at','=', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('status', 'Completed')
            ->count();
        $countPreviousMonth = Donation::whereYear('created_at','=', $previousMonth->year)
            ->whereMonth('created_at', $previousMonth->month)
            ->where('status', 'Completed')
            ->count();

        $monthlyCountGrowth = $countPreviousMonth > 0
            ? (($countThisMonth - $countPreviousMonth) / $countPreviousMonth) * 100
            : 0;

        $totalThisYear = Donation::whereYear('created_at','=', $currentYear)
            ->where('status', 'Completed')
            ->sum('amount');

        $avgDonation = $countThisYear > 0 ? $totalThisYear / $countThisYear : 0;
        // Generate chart data for the last 7 days (mini sparkline effect)
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dailyAmount = Donation::whereDate('created_at','=', $date->toDateString())
                ->where('status', 'Completed')
                ->sum('amount');
            $last7Days[] = $dailyAmount;
        }

        return [
            Stat::make('Successful Donations (This Month)', number_format($countThisMonth))
                ->description(($monthlyCountGrowth >= 0 ? '+' : '') . number_format($monthlyCountGrowth, 1) . '% from last month')
                ->descriptionIcon($monthlyCountGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([$countPreviousMonth, $countThisMonth])
                ->color($monthlyCountGrowth >= 0 ? 'info' : 'warning'),
            Stat::make('Average Donation', 'KES ' . number_format($avgDonation, 2))
                ->description('Per donation this year')
                ->descriptionIcon('heroicon-m-calculator')
                ->chart($last7Days)
                ->color('primary'),
        ];
    }
}
