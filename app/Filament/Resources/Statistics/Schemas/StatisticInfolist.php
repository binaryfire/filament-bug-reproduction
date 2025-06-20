<?php

namespace App\Filament\Resources\Statistics\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StatisticInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),

                TextEntry::make('description'),

            ]);
    }
}
