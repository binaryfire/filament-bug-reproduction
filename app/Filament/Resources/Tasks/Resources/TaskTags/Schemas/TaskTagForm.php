<?php

namespace App\Filament\Resources\Tasks\Resources\TaskTags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskTagForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
