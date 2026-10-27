<?php

namespace App\Filament\Resources\EstimatorLeadResource\Pages;

use App\Filament\Resources\EstimatorLeadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstimatorLead extends EditRecord
{
    protected static string $resource = EstimatorLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
