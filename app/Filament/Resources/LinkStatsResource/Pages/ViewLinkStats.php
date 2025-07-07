<?php

namespace App\Filament\Resources\LinkStatsResource\Pages;

use App\Filament\Resources\LinkStatsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLinkStats extends ViewRecord
{
    protected static string $resource = LinkStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
