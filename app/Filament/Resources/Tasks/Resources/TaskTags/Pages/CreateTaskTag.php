<?php

namespace App\Filament\Resources\Tasks\Resources\TaskTags\Pages;

use App\Filament\Resources\Tasks\Resources\TaskTags\TaskTagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaskTag extends CreateRecord
{
    protected static string $resource = TaskTagResource::class;
}
