<?php

namespace App\Filament\Resources\Code\Schemas;

use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('code')
                    ->required()
                    ->columnSpanFull(),

                CodeEditor::make('code')
                    ->columnSpanFull(),
            ]);
    }
}
