<?php

namespace App\Filament\Resources\Code;

use App\Filament\Resources\Code\Pages\CreateCode;
use App\Filament\Resources\Code\Pages\EditCode;
use App\Filament\Resources\Code\Pages\ListCode;
use App\Filament\Resources\Code\Pages\ViewCode;
use App\Filament\Resources\Code\Schemas\CodeForm;
use App\Filament\Resources\Code\Schemas\CodeInfolist;
use App\Filament\Resources\Code\Tables\CodeTable;
use App\Models\Code;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CodeResource extends Resource
{
    protected static ?string $model = Code::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Code';

    protected static ?string $pluralModelLabel = 'code';

    protected static ?string $slug = 'code';

    public static function form(Schema $schema): Schema
    {
        return CodeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CodeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CodeTable::configure($table);
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
            'index' => ListCode::route('/'),
            'create' => CreateCode::route('/create'),
            'view' => ViewCode::route('/{record}'),
            'edit' => EditCode::route('/{record}/edit'),
        ];
    }
}
