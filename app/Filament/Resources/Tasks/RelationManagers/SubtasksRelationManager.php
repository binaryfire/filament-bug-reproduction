<?php

namespace App\Filament\Resources\Tasks\RelationManagers;

use App\Filament\Resources\Tasks\Resources\Subtasks\SubtaskResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class SubtasksRelationManager extends RelationManager
{
    protected static string $relationship = 'subtasks';

    protected static ?string $relatedResource = SubtaskResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
