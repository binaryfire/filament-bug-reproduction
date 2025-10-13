<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Size;

class DynamicNestedDefaultValueBug extends Page
{
    protected string $view = 'filament.pages.test-page';

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('nested')
                    ->label('Test Nested (Group)')
                    ->modalHeading('Dynamic + Nested')
                    ->modalSubmitActionLabel('Submit')
                    ->size(Size::Small)
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->options(['show' => 'Show Field'])
                            ->required()
                            ->live(),

                        Group::make()
                            ->schema(function (Get $get) {
                                if ($get('type') !== 'show') {
                                    return [];
                                }

                                return [
                                    Select::make('target')
                                        ->label('Target (should default to "New Window")')
                                        ->options([
                                            '_blank' => 'New Window',
                                            '_self' => 'Same Window',
                                        ])
                                        ->default('_blank')
                                        ->required(),
                                ];
                            }),
                    ])
                    ->action(function (array $data) {
                        Notification::make()
                            ->title('Submitted')
                            ->body('Target: ' . ($data['target'] ?? 'NULL'))
                            ->success()
                            ->send();

                        dump('Nested:', $data);
                    }),

                Action::make('flat')
                    ->label('Test Flat (No Group)')
                    ->modalHeading('Dynamic + Flat')
                    ->modalSubmitActionLabel('Submit')
                    ->size(Size::Small)
                    ->schema([
                        Select::make('type')
                            ->label('Type')
                            ->options(['show' => 'Show Field'])
                            ->required()
                            ->live(),

                        Select::make('target')
                            ->label('Target (should default to "New Window")')
                            ->options([
                                '_blank' => 'New Window',
                                '_self' => 'Same Window',
                            ])
                            ->default('_blank')
                            ->required()
                            ->visible(fn (Get $get) => $get('type') === 'show'),
                    ])
                    ->action(function (array $data) {
                        Notification::make()
                            ->title('Submitted')
                            ->body('Target: ' . ($data['target'] ?? 'NULL'))
                            ->success()
                            ->send();

                        dump('Flat:', $data);
                    }),
            ]);
    }
}
