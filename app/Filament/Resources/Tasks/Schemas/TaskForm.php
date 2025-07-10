<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),

                Textarea::make('description'),

                Select::make('tags')
                    ->label('Tags')
                    ->multiple()
                    ->relationship('tags', 'name')
                    ->preload(),

                DatePicker::make('due_date')
                    ->label('Due date')
                    ->placeholder('Select a date'),

                Select::make('priority')
                    ->label('Priority')
                    ->options([
                        '1' => 'Low',
                        '2' => 'Medium',
                        '3' => 'High',
                    ])
                    ->default('2'),
            ]);
    }
}
