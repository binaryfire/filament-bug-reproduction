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

class SelectInGroupBug extends Page
{
    protected string $view = 'filament.pages.test-page';

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('testDynamicSearchable')
                    ->label('Test Dynamic Searchable (validation fails)')
                    ->color('danger')
                    ->modalHeading('Dynamic Searchable Select')
                    ->modalSubmitActionLabel('Submit')
                    ->size(Size::Small)
                    ->schema([
                        TextInput::make('label')
                            ->label('Label')
                            ->required(),

                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'user' => 'User',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn ($state, Get $get, $set) => $set('data', [])),

                        Group::make()
                            ->statePath('data')
                            ->schema(function (Get $get) {
                                $type = $get('type');

                                if ($type === null || $type !== 'user') {
                                    return [];
                                }

                                return [
                                    Select::make('user_id')
                                        ->label('User (Searchable)')
                                        ->options(
                                            User::query()
                                                ->orderBy('name')
                                                ->pluck('name', 'id')
                                        )
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                ];
                            }),
                    ])
                    ->action(function (array $data) {
                        Notification::make()
                            ->title('Success')
                            ->body('Dynamic searchable worked!')
                            ->success()
                            ->send();

                        dump('Dynamic Searchable Data:', $data);
                    }),

                Action::make('testDynamicNative')
                    ->label('Test Dynamic Native (WORKS?)')
                    ->color('success')
                    ->modalHeading('Dynamic Native Select')
                    ->modalSubmitActionLabel('Submit')
                    ->size(Size::Small)
                    ->schema([
                        TextInput::make('label')
                            ->label('Label')
                            ->required(),

                        Select::make('type')
                            ->label('Type')
                            ->options([
                                'user' => 'User',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn ($state, Get $get, $set) => $set('data', [])),

                        Group::make()
                            ->statePath('data')
                            ->schema(function (Get $get) {
                                $type = $get('type');

                                if ($type === null || $type !== 'user') {
                                    return [];
                                }

                                return [
                                    Select::make('user_id')
                                        ->label('User (Native)')
                                        ->options(
                                            User::query()
                                                ->orderBy('name')
                                                ->pluck('name', 'id')
                                        )
                                        ->native(true)
                                        ->required(),
                                ];
                            }),
                    ])
                    ->action(function (array $data) {
                        Notification::make()
                            ->title('Success')
                            ->body('Dynamic native worked!')
                            ->success()
                            ->send();

                        dump('Dynamic Native Data:', $data);
                    }),
            ]);
    }
}
