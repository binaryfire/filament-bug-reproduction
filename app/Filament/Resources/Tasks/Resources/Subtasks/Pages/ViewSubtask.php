<?php

namespace App\Filament\Resources\Tasks\Resources\Subtasks\Pages;

use App\Filament\Resources\Tasks\Resources\Subtasks\SubtaskResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubtask extends ViewRecord
{
    protected static string $resource = SubtaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
