<?php

namespace App\Filament\Resources\Tasks\Resources\Subtasks;

use App\Filament\Resources\Tasks\Resources\Subtasks\Pages\CreateSubtask;
use App\Filament\Resources\Tasks\Resources\Subtasks\Pages\EditSubtask;
use App\Filament\Resources\Tasks\Resources\Subtasks\Pages\ViewSubtask;
use App\Filament\Resources\Tasks\Resources\Subtasks\Schemas\SubtaskForm;
use App\Filament\Resources\Tasks\Resources\Subtasks\Schemas\SubtaskInfolist;
use App\Filament\Resources\Tasks\Resources\Subtasks\Tables\SubtasksTable;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Subtask;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubtaskResource extends Resource
{
    protected static ?string $model = Subtask::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = TaskResource::class;

    protected static ?string $slug = 'mini-tasks';

    protected static ?string $modelLabel = 'mini task';

    protected static ?string $pluralModelLabel = 'mini tasks';

    public static function form(Schema $schema): Schema
    {
        return SubtaskForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubtaskInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubtasksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'create' => CreateSubtask::route('/create'),
            'view' => ViewSubtask::route('/{record}'),
            'edit' => EditSubtask::route('/{record}/edit'),
        ];
    }
}
