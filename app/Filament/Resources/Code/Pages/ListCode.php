<?php

namespace App\Filament\Resources\Code\Pages;

use App\Filament\Resources\Code\CodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCode extends ListRecords
{
    protected static string $resource = CodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
