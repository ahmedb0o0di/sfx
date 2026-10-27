<?php

namespace App\Filament\Resources\CareerResource\RelationManagers;

use App\Models\CareerApplication;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    protected static ?string $title = 'Applications & CVs for this Role';

    protected static ?string $icon = 'heroicon-o-document-text';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Candidate Application Details')
                    ->schema([
                        Grid::make(12)->schema([
                            Select::make('status')
                                ->label('Recruitment Status')
                                ->options([
                                    'pending' => 'Pending Review',
                                    'reviewed' => 'Reviewed / Screened',
                                    'shortlisted' => 'Shortlisted',
                                    'interviewed' => 'Interview Scheduled / Completed',
                                    'rejected' => 'Archived / Rejected',
                                ])
                                ->required()
                                ->native(false)
                                ->columnSpan(6),

                            TextInput::make('created_at')
                                ->label('Applied On')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(6),

                            TextInput::make('name')
                                ->label('Candidate Name')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            TextInput::make('email')
                                ->label('Email')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            TextInput::make('phone')
                                ->label('Phone')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            Placeholder::make('cv_link')
                                ->label('Attached CV')
                                ->content(function (?CareerApplication $record) {
                                    if (!$record || empty($record->cv_path)) {
                                        return 'No CV attached.';
                                    }
                                    return new HtmlString('
                                        <a href="' . $record->cv_url . '" target="_blank" download class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-bold rounded bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 hover:bg-emerald-500/20">
                                            Download ' . e($record->cv_filename) . ' &rarr;
                                        </a>
                                    ');
                                })
                                ->columnSpan(12),

                            Textarea::make('cover_letter')
                                ->label('Candidate Response / Cover Statement')
                                ->rows(5)
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpanFull(),

                            Textarea::make('admin_notes')
                                ->label('Internal Reviewer Notes')
                                ->rows(3)
                                ->placeholder('Add notes from screening or interview...')
                                ->columnSpanFull(),
                        ]),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Candidate Name')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('cv_path')
                    ->label('CV File')
                    ->formatStateUsing(fn (?string $state): string => $state ? basename($state) : 'No CV')
                    ->icon(fn (?string $state) => $state ? 'heroicon-o-arrow-down-tray' : null)
                    ->color(fn (?string $state) => $state ? 'success' : 'gray')
                    ->tooltip(fn (CareerApplication $record) => $record->cv_path ? 'Download ' . $record->cv_filename : null)
                    ->url(fn (CareerApplication $record): ?string => $record->cv_url)
                    ->openUrlInNewTab(),

                TextColumn::make('cover_letter')
                    ->label('Candidate Response')
                    ->limit(40)
                    ->tooltip(fn (CareerApplication $record): ?string => $record->cover_letter),

                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'reviewed' => 'Reviewed',
                        'shortlisted' => 'Shortlisted',
                        'interviewed' => 'Interviewed',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Action::make('download_cv')
                    ->label('Download CV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (CareerApplication $record): bool => !empty($record->cv_path))
                    ->url(fn (CareerApplication $record): string => $record->cv_url)
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()
                    ->label('Review'),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
