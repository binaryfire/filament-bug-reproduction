<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar')
                    ->label('Avatar')
                    ->avatar()
                    ->imageEditor()
                    ->circleCropper()
                    ->disk('public')
                    ->directory('avatars')
                    ->visibility('public')
                    ->openable(),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique()
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->helperText(new HtmlString('The <strong>full name</strong>, including any middle names.'))
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('username')
                    ->columnSpanFull(),

                Repeater::make('pets')
                    ->label('Pets')
                    ->schema([
                        TextInput::make('name')
                            ->label('Pet Name')
                            ->required(),
                        TextInput::make('type')
                            ->label('Pet Type')
                            ->required(),
                    ])
                    ->columnSpanFull(),

                TextEntry::make('message')
                    ->label('')
                    ->state('Note: This is a long text entry. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.')
                    ->columnSpanFull(),

                DatePicker::make('dob')
                    ->label('Date of Birth')
                    ->placeholder('YYYY-MM-DD')
                    ->columnSpanFull(),

            ]);
    }
}
