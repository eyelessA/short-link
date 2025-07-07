<?php

namespace App\Filament\Resources\LinkUserResource\Pages;

use App\Filament\Resources\LinkUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLinkUsers extends ListRecords
{
    protected static string $resource = LinkUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
