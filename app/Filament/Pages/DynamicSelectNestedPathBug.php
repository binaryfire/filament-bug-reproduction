<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Size;

class DynamicSelectNestedPathBug extends Page
{
    protected string $view = 'filament.pages.test-page';

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('failing')
                    ->label('Searchable (FAILS)')
                    ->color('danger')
                    ->modalHeading('Dynamically Shown Searchable Select')
                    ->modalSubmitActionLabel('Submit')
                    ->size(Size::Small)
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->options(['user' => 'User'])
                            ->required()
                            ->live(),

                        Group::make()
                            ->schema(function (Get $get) {
                                if ($get('type') !== 'user') {
                                    return [];
                                }

                                return [
                                    Select::make('user_id')
                                        ->label('User')
                                        ->options(User::query()->orderBy('name')->pluck('name', 'id'))
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                ];
                            }),
                    ])
                    ->action(function (array $data) {
                        Notification::make()
                            ->title('Success!')
                            ->success()
                            ->send();

                        dump('Data:', $data);
                    }),

                Action::make('working')
                    ->label('Native (WORKS)')
                    ->color('success')
                    ->modalHeading('Dynamically Shown Native Select')
                    ->modalSubmitActionLabel('Submit')
                    ->size(Size::Small)
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->options(['user' => 'User'])
                            ->required()
                            ->live(),

                        Group::make()
                            ->schema(function (Get $get) {
                                if ($get('type') !== 'user') {
                                    return [];
                                }

                                return [
                                    Select::make('user_id')
                                        ->label('User')
                                        ->options(User::query()->orderBy('name')->pluck('name', 'id'))
                                        ->native(true)
                                        ->required(),
                                ];
                            }),
                    ])
                    ->action(function (array $data) {
                        Notification::make()
                            ->title('Success!')
                            ->success()
                            ->send();

                        dump('Data:', $data);
                    }),
            ]);
    }
}
