<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\TaskResource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Support\Icons\Heroicon;

class CreateTask extends CreateRecord
{
    use HasWizard;

    protected static string $resource = TaskResource::class;

    /**
     * Get Wizard Steps
     */
    protected function getSteps(): array
    {
        return [
            Step::make('Step 1')
                ->description('Basic information about your task')
                ->icon(Heroicon::FolderOpen)
                ->schema([
                    TextInput::make('title')
                        ->required(),

                    Textarea::make('description'),
                ]),

            Step::make('Step 2')
                ->description('Set due date and priority')
                ->icon(Heroicon::InformationCircle)
                ->schema([
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
                ]),
        ];
    }
}
