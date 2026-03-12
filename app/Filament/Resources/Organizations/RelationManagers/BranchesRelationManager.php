<?php

namespace App\Filament\Resources\Organizations\RelationManagers;

use App\Filament\Resources\Branches\BranchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BranchesRelationManager extends RelationManager
{
    protected static string $relationship = 'branches';

    protected static ?string $relatedResource = BranchResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('city'),
                TextColumn::make('status')->badge(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
