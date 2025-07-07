<?php

namespace App\Filament\Resources\LinkStatsResource\Pages;

use App\Filament\Resources\LinkStatsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLinkStats extends EditRecord
{
    protected static string $resource = LinkStatsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
