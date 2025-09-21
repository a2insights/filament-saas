<?php

namespace A2Insights\FilamentSaas\User\Filament\Widgets;

use A2Insights\FilamentSaas\User\Stats\UserStats;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\LineChartWidget;

class UsersChart extends LineChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Users Chart';

    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $stats = UserStats::query()
            ->start(now()->subMonths(11))
            ->end(now()->subSecond())
            ->groupByMonth()
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $stats->pluck('value')->toArray(),
                ],
            ],
            'labels' => $stats->pluck('start')->map(fn ($date) => $date->format('M'))->toArray(),
        ];
    }

    public function getColumnSpan(): int|string|array
    {
        return 2;
    }
}
