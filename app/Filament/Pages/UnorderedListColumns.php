<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Components\UnorderedList;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;


class UnorderedListColumns extends Page
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
                Section::make('UnorderedList columns() bug')
                    ->description('Should display in 1 column but shows 2 columns on wider screens')
                    ->schema([
                        UnorderedList::make([
                            Text::make('Lorem ipsum'),
                            Text::make('Dolor sit amet'),
                            Text::make('Consectetur adipiscing'),
                            Text::make('Sed do eiusmod'),
                            Text::make('Tempor incididunt'),
                            Text::make('Ut labore et dolore'),
                            Text::make('Magna aliqua'),
                            Text::make('Ut enim ad minim'),
                            Text::make('Veniam quis nostrud'),
                            Text::make('Exercitation ullamco'),
                        ])
                        //->extraAttributes(['style' => 'columns: 1 !important;']) // Have to do this atm to force single column
                        ->columns(1), // Should force single column but doesn't work
                    ]),
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
