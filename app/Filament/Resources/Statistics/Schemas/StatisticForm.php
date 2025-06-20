<?php

namespace App\Filament\Resources\Statistics\Schemas;

use App\Filament\Resources\Statistics\Widgets\StatChartWidget;
use Filament\Forms\Components\CodeEditor;
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
                    ->hidden(fn ($operation) => $operation === 'create')
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
                ->hidden(fn ($operation) => $operation === 'create')
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
                ->hidden(fn ($operation) => $operation === 'create')
                ->tabs([
                    Tab::make('Raw')
                        ->schema([
                            KeyValueEntry::make('data')
                                ->label('Raw data')
                                ->keyLabel('Month')
                                ->valueLabel('Value'),

                            CodeEditor::make('data')
                                ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT) : $state)
                                ->label('Raw data')
                                ->disabled()
                                ->columnSpanFull(),
                        ]),

                    Tab::make('Chart')
                        ->schema([
                            Livewire::make(StatChartWidget::class, fn ($record) => [
                                    'record' => $record,
                                ])
                                ->key(Str::random(10))
                                ->columnSpanFull(),
                        ]),
                ]),
        ];
    }
}
