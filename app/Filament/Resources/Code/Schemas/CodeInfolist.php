<?php

namespace App\Filament\Resources\Code\Schemas;

use Filament\Infolists\Components\CodeEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Phiki\Grammar\Grammar;

class CodeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),

                CodeEntry::make('code')
                    ->grammar(Grammar::Html),

                // CodeEntry::make('code')
                //     ->grammar(Grammar::Json),

                // TextEntry::make('code'),

                TextEntry::make('created_at')
                    ->dateTime(),

            ]);
    }
}
