<?php

namespace App\Filament\Resources\Statistics\Pages;

use App\Filament\Resources\Statistics\StatisticResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class EditStatistic extends EditRecord
{
    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Action::make('refreshData')
                    ->label('Refresh data')
                    ->icon('heroicon-o-arrow-path')
                    ->action(function () {
                        $this->record->refreshData();

                        Notification::make()
                            ->success()
                            ->title('Data refreshed')
                            ->send();
                    }),

                $this->getFormContentComponent(),
                $this->getRelationManagersContentComponent(),
            ]);
    }
}
