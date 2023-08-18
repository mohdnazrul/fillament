<?php

namespace App\Filament\Resources\TaskManagementResource\Pages;

use App\Filament\Resources\TaskManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskManagement extends EditRecord
{
    protected static string $resource = TaskManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
