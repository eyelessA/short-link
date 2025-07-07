<?php

namespace App\Filament\Resources\LinkStatsResource\Pages;

use App\Filament\Resources\LinkStatsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLinkStats extends ListRecords
{
    protected static string $resource = LinkStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
