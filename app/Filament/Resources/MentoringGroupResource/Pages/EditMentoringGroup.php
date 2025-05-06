<?php

namespace App\Filament\Resources\MentoringGroupResource\Pages;

use App\Filament\Resources\MentoringGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMentoringGroup extends EditRecord
{
    protected static string $resource = MentoringGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
