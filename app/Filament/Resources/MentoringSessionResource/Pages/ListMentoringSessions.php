<?php

namespace App\Filament\Resources\MentoringSessionResource\Pages;

use App\Filament\Resources\MentoringSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMentoringSessions extends ListRecords
{
    protected static string $resource = MentoringSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
