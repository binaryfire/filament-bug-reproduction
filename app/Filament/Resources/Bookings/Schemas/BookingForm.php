<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Section 1')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('venue_id')
                            ->options([
                                '1' => 'Cafe',
                                '2' => 'Hall',
                            ])
                            ->live()
                            ->searchable()
                            ->preload()
                            ->required(),

                        Toggle::make('disabled_dates')
                            ->label('Disable Dates')
                            ->live(),

                        DatePicker::make('date')
                            ->native(false)
                            ->required()
                            ->closeOnDateSelection()
                            ->disabledDates(function (Get $get) {
                                if ($get('disabled_dates')) {
                                    return [now()->addDays(1)->toDateString()];
                                }
                                return [];
                            })
                            ->minDate(now()->subDays(20))
                            ->maxDate(now()->addDays(15))
                            ->live(),

                        Select::make('slot_id')
                            ->options([
                                '1' => '10:00',
                                '2' => '11:00',
                                '3' => '14:00',
                            ])
                            ->visible(fn(Get $get) => $get('date') && $get('venue_id'))
                            ->required(),
                    ]),

                Section::make('Section 2')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                    ]),

                Section::make('Section 3')
                    ->columnSpanFull()
                    ->schema([
                        DatePicker::make('date_of_birth')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->required()
                            ->maxDate(now())
                            ->before(now()),
                    ]),

                Section::make('Section 4')
                    ->columnSpanFull()
                    ->schema([
                        DatePicker::make('date_of_wedding')
                            ->maxDate(now())
                            ->native(false)
                            ->closeOnDateSelection()
                            ->before(now())
                            ->required(),
                    ]),
            ]);
    }
}
