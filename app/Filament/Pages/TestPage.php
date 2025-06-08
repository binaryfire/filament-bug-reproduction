<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\OneTimeCodeInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

class TestPage extends Page
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

                Action::make('testAction')
                    ->color('gray')
                    ->label('Test Action')
                    ->modalWidth(Width::TwoExtraLarge)
                    ->schema([
                        TextInput::make('name')
                                ->columnSpanFull(),

                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])
                    ->action(fn() => dd('Test Action'))
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
                ToggleButtons::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'published' => 'Published'
                    ])
                    ->colors([
                        'draft' => 'info',
                        'scheduled' => 'warning',
                        'published' => 'success',
                    ]),

                TextInput::make('name')
                    ->required(),

                TextInput::make('code')
                    ->required()
                    ->numeric()
                    ->type('text')
                    ->length(6)
                    //
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
