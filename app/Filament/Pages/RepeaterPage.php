<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;

class RepeaterPage extends Page
{
    protected string $view = 'filament.pages.test-page';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                $this->getFormContentComponent(),
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
                Tabs::make('tabs')
                    ->live(debounce: 300)
                    ->persistTab()
                    ->tabs([
                        Tab::make(__('Mr Gruber'))
                            ->schema([
                                Repeater::make('items')
                                    ->live(debounce: 300)
                                    ->hiddenLabel()
                                    ->addActionLabel('Add item')
                                    ->table([
                                        TableColumn::make('in_stock'),

                                        TableColumn::make('name')
                                            ->alignment(Alignment::Start)
                                            ->markAsRequired(),

                                        TableColumn::make('description')
                                            ->alignment(Alignment::Start),
                                    ])
                                    ->schema([
                                        Checkbox::make('in_stock')
                                            ->default(true),

                                        TextInput::make('name'),

                                        TextInput::make('description'),
                                    ])
                            ]),

                        Tab::make('Tabbington Bear')
                            ->schema([
                                TextInput::make('name')
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->columnSpanFull(),
                            ]),
                ])
                ->columnSpanFull(),
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
