<?php

namespace App\Filament\Resources\Code\Pages;

use App\Filament\Resources\Code\CodeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCode extends EditRecord
{
    protected static string $resource = CodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
