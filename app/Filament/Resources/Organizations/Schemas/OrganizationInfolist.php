<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Organization Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->weight('bold'),

                                TextEntry::make('email')
                                    ->copyable()
                                    ->icon('heroicon-m-envelope'),

                                TextEntry::make('phone')
                                    ->icon('heroicon-m-phone'),

                                TextEntry::make('created_at')
                                    ->label('Joined')
                                    ->dateTime('M d, Y'),

                                TextEntry::make('address')
                                    ->columnSpanFull()
                                    ->markdown(),

                                TextEntry::make('status')
                                    ->badge(),

                                TextEntry::make('plan.name')->label('Plan')
                                    ->badge(),

                            ]),
                    ]),
            ]);
    }
}
