<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Text;
use Illuminate\Support\Str;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    private string | null $newToken = null;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),

            Action::make('regenateToken')
                ->label('Regenerate token')
                ->color('warning')
                ->action(function () {
                    $this->newToken = Str::uuid();

                    Notification::make()
                        ->title('Token regenerated')
                        ->success()
                        ->send();

                    $this->replaceMountedAction('showNewToken');
                }),

            Action::make('regenateTokenWithConfirmation')
                ->label('Regenerate token - confirmation modal')
                ->modalHeading('Regenerate token - confirmation modal')
                ->requiresConfirmation()
                ->color('warning')
                ->action(function () {
                    $this->newToken = Str::uuid();

                    Notification::make()
                        ->title('Token regenerated')
                        ->success()
                        ->send();

                    $this->replaceMountedAction('showNewToken');
                }),

            Action::make('regenateTokenWithModal')
                ->label('Regenerate token - custom modal')
                ->modalHeading('Regenerate token - custom modal')
                ->modalDescription('Are you sure you want to regenerate the token?')
                ->modalSubmitActionLabel('Yes')
                ->color('warning')
                ->action(function () {
                    $this->newToken = Str::uuid();

                    Notification::make()
                        ->title('Token regenerated')
                        ->success()
                        ->send();

                    $this->replaceMountedAction('showNewToken');
                }),
        ];
    }

    /**
     * Show new token
     */
    public function showNewTokenAction(): Action
    {
        return Action::make('showNewToken')
            ->modalHeading(__('Your new token'))
            ->closeModalByClickingAway(false)
            ->closeModalByEscaping(false)
            ->modalCloseButton(false)
            ->modalCancelAction(false)
            ->modalSubmitActionLabel('Ok')
            ->schema([
                Text::make(function (): string {
                    return $this->newToken;
                })
            ]);
    }
}
