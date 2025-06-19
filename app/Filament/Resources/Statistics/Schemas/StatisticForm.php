<?php

namespace App\Filament\Resources\Statistics\Schemas;

use App\Filament\Resources\Statistics\Widgets\StatChartWidget;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class StatisticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Livewire::make(StatChartWidget::class, fn ($record) => [
                        'record' => $record,
                    ])
                    ->key(Str::random(10))
                    ->columnSpanFull(),

                Tabs::make('tabs')
                    ->contained(false)
                    ->tabs([
                        Tab::make(__('Fields'))
                            ->schema(static::getFormFields()),
                        Tab::make(__('Data'))
                            ->schema(static::getDataFields()),
                ])
                ->columnSpanFull(),
            ]);
    }

    /**
     * Get form fields
     */
    private static function getFormFields(): array
    {
        return [
            TextInput::make('name')
                ->required(),

            Textarea::make('description'),

            Livewire::make(StatChartWidget::class, fn ($record) => [
                    'record' => $record,
                ])
                ->key(Str::random(10))
                ->columnSpanFull(),
        ];
    }

    /**
     * Get data fields
     */
    private static function getDataFields(): array
    {
        return [
            Tabs::make('Data')
                ->tabs([
                    Tab::make('Raw')
                        ->schema([
                            KeyValueEntry::make('data')
                                ->label('Raw data')
                                ->keyLabel('Month')
                                ->valueLabel('Value'),

                        ]),

                    Tab::make('Chart')
                        ->schema([
                            Livewire::make(StatChartWidget::class, fn ($record) => [
                                    'record' => $record,
                                ])
                                ->key(Str::random(10))
                                ->columnSpanFull()
                                ->extraAttributes(['wire:loading.class' => 'chart-loading']),
                        ]),
                ]),
        ];
    }
}
