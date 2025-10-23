<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EscapeKeyModalBug extends Page
{
    protected string $view = 'filament.pages.test-page';

    protected static ?string $title = 'Escape Key Modal Bug Test';

    public int $escapeCount = 0;
    public int $modalOpenCount = 0;

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Test Area')
                ->description('This section has a back button with escape binding')
                ->headerActions([
                    Action::make('backButton')
                        ->label('Back (Escape)')
                        ->icon('heroicon-o-arrow-left')
                        ->color('danger')
                        ->keyBindings(['escape'])
                        ->action(function () {
                            Notification::make()
                                ->title('Back Action Fired!')
                                ->body('This should not fire when closing a modal with escape.')
                                ->danger()
                                ->send();
                        }),
                ])
                ->schema([
                    Action::make('openNestedModal')
                        ->label('Edit Item (Opens Modal)')
                        ->icon('heroicon-o-pencil')
                        ->schema([
                            TextInput::make('test')
                                ->label('Test Input')
                                ->required(),
                        ])
                        ->action(function (array $data) {
                            Notification::make()
                                ->title('Modal Submitted')
                                ->success()
                                ->send();
                        }),
                ]),
        ]);
    }
}
