<?php

namespace App\Filament\Resources\MentoringGroupResource\Pages;

use App\Filament\Resources\MentoringGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMentoringGroups extends ListRecords
{
    protected static string $resource = MentoringGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
