<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

class ModalTabPersist extends Page
{
    protected string $view = 'filament.pages.test-page';

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('testAction')
                    ->label('Test Action')
                    ->color('gray')
                    ->modalWidth(Width::TwoExtraLarge)
                    ->schema([
                        Tabs::make('Tabs')
                            ->persistTab()
                            ->id('custom-tabs-id')
                            ->tabs([
                                Tab::make('Tab 1')
                                    ->schema([
                                        TextInput::make('name')
                                                ->columnSpanFull(),
                                    ]),

                                Tab::make('Tab 2')
                                    ->schema([
                                        Textarea::make('description')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->action(fn($data) => dd($data)),
            ]);
    }
}
