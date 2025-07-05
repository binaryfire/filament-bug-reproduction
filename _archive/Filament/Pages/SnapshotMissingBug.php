<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TestBarChartWidget;
use App\Filament\Widgets\UsersTableWidget;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class SnapshotMissingBug extends Page
{
    protected string $view = 'filament.pages.test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    // #[On('new-data')]
    // public function refreshParent(array $data): void
    // {
    //     $this->form->fill($data);
    // }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),

                Flex::make([
                    Group::make([
                            Livewire::make(UsersTableWidget::class),
                        ])
                        ->extraAttributes(['class' => 'users-table-widget'])
                        ->grow(false),

                    Section::make([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tab::make('Tab 1')
                                    ->schema([
                                        Text::make('Hello World'),
                                    ]),

                                Tab::make('Tab 2')
                                    ->schema([
                                        Livewire::make(TestBarChartWidget::class)
                                            // Add unique key to avoid diffing issues
                                            ->key(Str::random(10)),
                                    ]),
                            ]),
                    ]),
                ])
                ->from('md'),

                // Action::make('refreshParent')
                //     ->action(function () {
                //         $this->dispatch('new-data', [
                //             'number' => Str::random(10),
                //         ]);

                //         Notification::make()
                //             ->title('Data Updated')
                //             ->success()
                //             ->send();
                //     }),
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
                TextInput::make('number')
                    ->required(),
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

        //dd($data);

        Notification::make()
            ->title("New number: {$data['number']}")
            ->success()
            ->send();
    }
}
