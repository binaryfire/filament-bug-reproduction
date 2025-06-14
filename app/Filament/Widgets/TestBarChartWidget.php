<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class TestBarChartWidget extends ChartWidget
{
    protected ?string $heading = 'Test Chart';

    protected $listeners = ['new-data' => '$refresh'];

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Series A',
                    'data' => [10, 20, 30],
                    'backgroundColor' => '#3B82F6',
                ],
                [
                    'label' => 'Series B',
                    'data' => [15, 25, 35],
                    'backgroundColor' => '#10B981',
                ],
                [
                    'label' => 'Series C',
                    'data' => [5, 15, 25],
                    'backgroundColor' => '#F59E0B',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
        ];
    }
}
