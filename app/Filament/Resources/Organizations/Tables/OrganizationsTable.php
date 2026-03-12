<?php

namespace App\Filament\Resources\Organizations\Tables;

use App\Enum\OrganizationStatus;
use App\Models\Organization;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class OrganizationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ref')
                    ->label('REF')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono'),

                ImageColumn::make('profile_photo')->label('')->circular(false)->imageHeight(40)
                    ->defaultImageUrl(function ($record) {
                        return 'https://ui-avatars.com/api/?background=random&name='.urlencode($record->name);
                    }),

                TextColumn::make('name')
                    ->label('Organization')
                    ->description(fn (Organization $record): string => $record->email)
                    ->searchable(['name', 'email'])
                    ->sortable(),

                TextColumn::make('plan.name')
                    ->label('Current Plan')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('created_at')->label('Joined')->dateTime('d M Y')->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('plan_id')
                    ->label('Plan')
                    ->relationship('plan', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('status')
                    ->options(fn () => OrganizationStatus::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
