<?php

namespace App\Filament\Resources\Statistics\Widgets;

use App\Models\Statistic;
use Filament\Widgets\ChartWidget;
use Livewire\Attributes\Reactive;

class StatChartWidget extends ChartWidget
{
    protected ?string $heading = 'Stats Chart';

    #[Reactive]
    public ?Statistic $record = null;

    protected function getData(): array
    {
        if (!$this->record || !$this->record->data) {
            return [
                'datasets' => [
                    [
                        'label' => 'Sample Data',
                        'data' => [],
                        'backgroundColor' => '#3B82F6',
                    ],
                ],
                'labels' => [],
            ];
        }

        $data = $this->record->data;

        return [
            'datasets' => [
                [
                    'label' => 'Sample Data',
                    'data' => array_values($data),
                    'backgroundColor' => '#3B82F6',
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function refreshData(): void
    {
        if ($this->record) {
            $this->record->refreshData();
            $this->updateChartData();
        }
    }
}
