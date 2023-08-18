<?php

namespace App\Filament\Resources\TaskManagementResource\Pages;

use App\Filament\Resources\TaskManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskManagement extends ListRecords
{
    protected static string $resource = TaskManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
