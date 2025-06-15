<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TestBarChartWidget;
use Filament\Actions\Action;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Livewire;
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
                    ->color('info')
                    ->label('Test Action')
                    ->modalWidth(Width::TwoExtraLarge)
                    ->schema([
                        TextInput::make('name')
                                ->columnSpanFull(),

                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])
                    ->action(fn($data) => dd($data)),

                Livewire::make(TestBarChartWidget::class),
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

                // CodeEditor::make('code')
                //     ->default(fn() => $this->getExampleData())
                //     ->disabled()
                //     ->language(Language::Json),
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

    /**
     * Get example JSON data
     */
    private function getExampleData(): string
    {
        return json_encode([
            'name' => 'Example Request',
            'url' => 'https://api.example.com/data',
            'method' => 'GET',
            'headers' => [
                'Authorization' => 'Bearer your_token_here',
                'Content-Type' => 'application/json',
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
