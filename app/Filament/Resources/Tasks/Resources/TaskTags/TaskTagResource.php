<?php

namespace App\Filament\Resources\Tasks\Resources\TaskTags;

use App\Filament\Resources\Tasks\Resources\TaskTags\Pages\CreateTaskTag;
use App\Filament\Resources\Tasks\Resources\TaskTags\Pages\EditTaskTag;
use App\Filament\Resources\Tasks\Resources\TaskTags\Schemas\TaskTagForm;
use App\Filament\Resources\Tasks\Resources\TaskTags\Tables\TaskTagsTable;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\TaskTag;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TaskTagResource extends Resource
{
    protected static ?string $model = TaskTag::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = TaskResource::class;

    public static function form(Schema $schema): Schema
    {
        return TaskTagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaskTagsTable::configure($table);
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
            'create' => CreateTaskTag::route('/create'),
            'edit' => EditTaskTag::route('/{record}/edit'),
        ];
    }
}
