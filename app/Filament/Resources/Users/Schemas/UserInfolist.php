<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('lastestCode.code'),

                Section::make()
                    ->heading('Information')
                    ->description('Additional information.')
                    ->schema([
                        TextEntry::make('webhook_url')
                            ->label('Webhook URL')
                            ->state('https://tenant1.someappdomain.test/webhooks/incoming/019761a0-003c-7254-a477-a42ae760badd')
                            ->copyable()
                            ->copyMessage('Webhook URL copied'),
                    ]),

                TextEntry::make('name'),

                TextEntry::make('username'),

                TextEntry::make('dob')
                    ->date(),

                TextEntry::make('email'),

                TextEntry::make('email_verified_at')
                    ->dateTime(),

                TextEntry::make('created_at')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
