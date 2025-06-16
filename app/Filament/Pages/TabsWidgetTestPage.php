<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TestBarChartWidget;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class TabsWidgetTestPage extends Page
{
    protected string $view = 'filament.pages.test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    #[On('new-data')]
    public function refreshParent(array $data): void
    {
        $this->form->fill($data);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),

                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Tab 1')
                            ->schema([
                                Text::make('Hello World'),
                            ]),

                        Tab::make('Tab 2')
                            ->schema([
                                Livewire::make(TestBarChartWidget::class),
                            ]),
                    ]),

                Action::make('refreshParent')
                    ->action(function () {
                        $this->dispatch('new-data', [
                            'uuid' => Str::uuid(),
                        ]);

                        Notification::make()
                            ->title('Data Updated')
                            ->success()
                            ->send();
                    })

                // Action::make('refreshParent')
                //     ->schema([
                //         TextInput::make('new_name')
                //             ->required()
                //             ->columnSpanFull(),
                //     ])
                //     ->action(function (array $data) {
                //         $this->dispatch('new-data', [
                //             'name' => $data['new_name'],
                //         ]);

                //         Notification::make()
                //             ->title('Data Updated')
                //             ->success()
                //             ->send();
                //     })
            ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),

                TextInput::make('uuid'),
            ]);
    }

    public function getFormContentComponent(): Component
    {
        return Form::make([EmbeddedSchema::make('form')])
            ->id('form')
            ->livewireSubmitHandler('execute')
            ->footer([
                Actions::make([
                    Action::make('execute')
                        ->label('Submit')
                        ->submit('execute'),
                    ]),
            ]);
    }

    public function execute(): void
    {
        $data = $this->form->getState();
        dd($data);
    }
}
