<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TestBarChartWidget;
use Filament\Actions\Action;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;

class ViteDevStylesBug extends Page
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
                Action::make('testAction')
                    ->label('Test Action')
                    ->color('gray')
                    ->modalWidth(Width::TwoExtraLarge)
                    ->schema([
                        TextInput::make('name')
                                ->columnSpanFull(),

                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])
                    ->action(fn($data) => dd($data)),

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
