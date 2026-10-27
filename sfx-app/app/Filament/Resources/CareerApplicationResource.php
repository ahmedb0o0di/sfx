<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerApplicationResource\Pages;
use App\Models\Career;
use App\Models\CareerApplication;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class CareerApplicationResource extends Resource
{
    protected static ?string $model = CareerApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Practice & Opportunities';

    protected static ?string $navigationLabel = 'Applications & CVs';

    protected static ?string $modelLabel = 'Career Application';

    protected static ?string $pluralModelLabel = 'Applications & CVs';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Review & Application Status')
                    ->description('Update candidate processing status and record internal recruitment notes.')
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
                                ->columnSpan(4),

                            TextInput::make('created_at')
                                ->label('Submission Date')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            TextInput::make('job_title')
                                ->label('Applied Position')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            Textarea::make('admin_notes')
                                ->label('Internal Recruiter Notes')
                                ->placeholder('Add comments from interview, salary expectations, structural feedback...')
                                ->rows(3)
                                ->columnSpanFull(),
                        ]),
                    ]),

                Section::make('Candidate Profile & CV')
                    ->description('Contact coordinates, portfolio credentials, and submitted curriculum vitae.')
                    ->schema([
                        Grid::make(12)->schema([
                            TextInput::make('name')
                                ->label('Candidate Full Name')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            TextInput::make('email')
                                ->label('Email Address')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            TextInput::make('phone')
                                ->label('Telephone / WhatsApp')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(4),

                            TextInput::make('portfolio_url')
                                ->label('Portfolio / LinkedIn URL')
                                ->disabled()
                                ->dehydrated(false)
                                ->columnSpan(6),

                            Placeholder::make('cv_download')
                                ->label('Attached Curriculum Vitae (CV / Resume)')
                                ->content(function (?CareerApplication $record) {
                                    if (!$record || empty($record->cv_path)) {
                                        return new HtmlString('<span class="text-gray-400 italic">No CV document uploaded.</span>');
                                    }
                                    $url = $record->cv_url;
                                    $filename = $record->cv_filename;
                                    return new HtmlString('
                                        <div class="mt-1 flex items-center gap-3">
                                            <a href="' . $url . '" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-lg bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 hover:bg-emerald-500/20 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Download CV: ' . e($filename) . '
                                            </a>
                                            <a href="' . $url . '" target="_blank" class="text-xs text-primary-500 hover:underline">
                                                Open in new tab &rarr;
                                            </a>
                                        </div>
                                    ');
                                })
                                ->columnSpan(6),
                        ]),
                    ]),

                Section::make('Candidate Response & Cover Letter')
                    ->description('Candidate statement of interest, technical experience, and membrane engineering competencies.')
                    ->schema([
                        Textarea::make('cover_letter')
                            ->label('Candidate Response / Cover Statement')
                            ->rows(8)
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),

                TextColumn::make('job_title')
                    ->label('Job Applied For')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->badge()
                    ->color('info')
                    ->description(fn (CareerApplication $record): ?string => $record->career?->department),

                TextColumn::make('name')
                    ->label('Candidate')
                    ->searchable()
                    ->weight('semibold'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->icon('heroicon-m-phone'),

                TextColumn::make('cv_path')
                    ->label('CV File')
                    ->formatStateUsing(fn (?string $state): string => $state ? basename($state) : 'No CV')
                    ->icon(fn (?string $state) => $state ? 'heroicon-o-arrow-down-tray' : null)
                    ->color(fn (?string $state) => $state ? 'success' : 'gray')
                    ->tooltip(fn (CareerApplication $record) => $record->cv_path ? 'Click to download CV: ' . $record->cv_filename : null)
                    ->url(fn (CareerApplication $record): ?string => $record->cv_url)
                    ->openUrlInNewTab(),

                TextColumn::make('cover_letter')
                    ->label('Response Preview')
                    ->limit(45)
                    ->tooltip(fn (CareerApplication $record): ?string => $record->cover_letter),

                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'reviewed' => 'Reviewed',
                        'shortlisted' => 'Shortlisted',
                        'interviewed' => 'Interviewed',
                        'rejected' => 'Rejected',
                    ])
                    ->selectablePlaceholder(false),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('job_title')
                    ->label('Filter by Position')
                    ->options(fn () => Career::pluck('title', 'title')->toArray()),

                SelectFilter::make('status')
                    ->label('Filter by Status')
                    ->options([
                        'pending' => 'Pending',
                        'reviewed' => 'Reviewed',
                        'shortlisted' => 'Shortlisted',
                        'interviewed' => 'Interviewed',
                        'rejected' => 'Rejected',
                    ]),
            ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareerApplications::route('/'),
            'edit' => Pages\EditCareerApplication::route('/{record}/edit'),
        ];
    }
}
