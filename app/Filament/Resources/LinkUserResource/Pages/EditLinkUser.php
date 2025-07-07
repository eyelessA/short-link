<?php

namespace App\Filament\Resources\LinkUserResource\Pages;

use App\Filament\Resources\LinkUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLinkUser extends EditRecord
{
    protected static string $resource = LinkUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
