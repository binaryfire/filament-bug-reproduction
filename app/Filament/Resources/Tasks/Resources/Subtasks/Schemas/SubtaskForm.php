<?php

namespace App\Filament\Resources\Tasks\Resources\Subtasks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubtaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Title')
                    ->placeholder('Enter subtask title'),

                Textarea::make('description')
                    ->label('Description')
                    ->placeholder('Enter subtask description'),

                DatePicker::make('completed_at')
                    ->label('Completed at')
                    ->placeholder('Select a date'),
            ]);
    }
}
