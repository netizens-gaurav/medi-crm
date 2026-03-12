<?php

namespace App\Filament\Resources\Organizations\Pages;

use App\Enum\OrganizationStatus;
use App\Filament\Resources\Organizations\OrganizationResource;
use App\Filament\Resources\Organizations\Widgets\OrganizationOverview;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewOrganization extends ViewRecord
{
    protected static string $resource = OrganizationResource::class;

    public function getTitle(): string|Htmlable
    {
        return $this->record->name;
    }

    public function getSubheading(): string|Htmlable
    {
        return $this->record->email;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('suspend')
                ->label('Suspend Organization')
                ->color('danger')
                ->icon('heroicon-o-no-symbol')
                ->visible(fn ($record) => $record->status === OrganizationStatus::Active)
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->update(['status' => OrganizationStatus::Suspended]);
                    Notification::make()
                        ->title('Suspended successfully')
                        ->icon('heroicon-o-no-symbol')
                        ->danger()
                        ->send();
                }),

            Action::make('activate')
                ->label('Activate Organization')
                ->color('success')
                ->icon('heroicon-m-check-badge')
                ->visible(fn ($record) => $record->status === OrganizationStatus::Suspended)
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->update(['status' => OrganizationStatus::Active]);
                    Notification::make()
                        ->title('Suspended successfully')
                        ->icon('heroicon-m-check-badge')
                        ->success()
                        ->send();
                }),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrganizationOverview::class,
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-o-pencil-square';
    }
}
