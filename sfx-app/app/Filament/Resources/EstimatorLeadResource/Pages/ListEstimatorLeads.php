<?php

namespace App\Filament\Resources\EstimatorLeadResource\Pages;

use App\Filament\Resources\EstimatorLeadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEstimatorLeads extends ListRecords
{
    protected static string $resource = EstimatorLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
