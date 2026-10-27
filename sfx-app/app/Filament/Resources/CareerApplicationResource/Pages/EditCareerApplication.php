<?php

namespace App\Filament\Resources\CareerApplicationResource\Pages;

use App\Filament\Resources\CareerApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareerApplication extends EditRecord
{
    protected static string $resource = CareerApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('download_cv')
                ->label('Download CV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn () => !empty($this->record->cv_path))
                ->url(fn () => $this->record->cv_url)
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
