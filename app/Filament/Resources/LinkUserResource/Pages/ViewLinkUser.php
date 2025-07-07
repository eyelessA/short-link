<?php

namespace App\Filament\Resources\LinkUserResource\Pages;

use App\Filament\Resources\LinkUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLinkUser extends ViewRecord
{
    protected static string $resource = LinkUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
