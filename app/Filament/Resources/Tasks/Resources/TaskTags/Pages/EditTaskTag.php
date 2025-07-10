<?php

namespace App\Filament\Resources\Tasks\Resources\TaskTags\Pages;

use App\Filament\Resources\Tasks\Resources\TaskTags\TaskTagResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTaskTag extends EditRecord
{
    protected static string $resource = TaskTagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
