<?php

namespace Wbasenl\MwguerraFileManager\Filament\Resources\FileSystemItemResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Wbasenl\MwguerraFileManager\Filament\Resources\FileSystemItemResource;

class EditFileSystemItem extends EditRecord
{
    protected static string $resource = FileSystemItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
