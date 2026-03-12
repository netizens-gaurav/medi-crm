<?php

namespace App\Filament\Resources\Organizations\Schemas;

use App\Enum\OrganizationStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->description('General details about the organization.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),

                        Select::make('plan_id')
                            ->relationship('plan', 'name')
                            ->searchable()
                            ->preload(),
                        // ->required(),
                    ])->columns(2),

                Section::make('System Details')
                    ->schema([
                        TextInput::make('ref')
                            ->label('Organization Reference')
                            ->default(fn () => strtoupper(Str::random(8)))
                            ->readonly()
                            ->required()
                            ->maxLength(8),

                        Select::make('status')
                            ->label('Status')
                            ->options(
                                OrganizationStatus::class
                            )
                            ->default('active')
                            ->native(false),

                        Textarea::make('address')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
