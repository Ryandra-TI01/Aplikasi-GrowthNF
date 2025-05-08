<?php

namespace App\Filament\Resources\MentoringSessionResource\Pages;

use App\Filament\Resources\MentoringSessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMentoringSession extends EditRecord
{
    protected static string $resource = MentoringSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
