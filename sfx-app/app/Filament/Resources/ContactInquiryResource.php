<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInquiryResource\Pages;
use App\Models\ContactInquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ContactInquiryResource extends Resource
{
    protected static ?string $model = ContactInquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Inquiries & Leads';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. Only editable section: Status dropdown
                Forms\Components\Section::make('Inquiry Status')
                    ->description('Update the processing status for this inquiry. This is the only editable field.')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'read' => 'Read',
                                'responsed' => 'Responsed',
                                'ignored' => 'Ignored',
                            ])
                            ->required()
                            ->default('pending')
                            ->selectablePlaceholder(false)
                            ->native(false),
                    ]),

                // 2. Read-Only Reference Information
                Forms\Components\Section::make('Client & Inquiry Details')
                    ->description('Read-only inquiry information submitted by the client.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Sender Name')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('phone')
                            ->label('Contact Phone')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('created_at')
                            ->label('Received At')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('subject')
                            ->label('Department / Subject')
                            ->columnSpanFull()
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Textarea::make('message')
                            ->label('Project Scope & Message')
                            ->rows(6)
                            ->columnSpanFull()
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Placeholder::make('download_link')
                            ->label('Attached Architectural / RFP File')
                            ->content(function (?ContactInquiry $record) {
                                if (!$record || empty($record->attachment_path)) {
                                    return 'No file attached.';
                                }
                                $filename = basename($record->attachment_path);
                                $exists = Storage::disk('public')->exists($record->attachment_path);
                                if (!$exists) {
                                    return $filename . ' (File not found on disk)';
                                }
                                $url = Storage::disk('public')->url($record->attachment_path);
                                return new HtmlString('
                                    <div class="flex items-center gap-2 mt-1">
                                        <a href="' . $url . '" target="_blank" download class="inline-flex items-center gap-2 px-3.5 py-2 text-sm font-semibold rounded-lg bg-amber-500/10 text-amber-500 border border-amber-500/20 hover:bg-amber-500/20 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            Download ' . e($filename) . '
                                        </a>
                                    </div>
                                ');
                            })
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(25),

                // Downloadable file name directly in the table
                Tables\Columns\TextColumn::make('attachment_path')
                    ->label('Attached File')
                    ->formatStateUsing(fn (?string $state): string => $state ? basename($state) : '—')
                    ->icon(fn (?string $state) => $state ? 'heroicon-o-arrow-down-tray' : null)
                    ->color(fn (?string $state) => $state ? 'warning' : 'gray')
                    ->tooltip(fn (?string $state) => $state ? 'Click to download ' . basename($state) : null)
                    ->url(fn (?ContactInquiry $record): ?string => $record && $record->attachment_path ? Storage::disk('public')->url($record->attachment_path) : null)
                    ->openUrlInNewTab(),

                // Inline editable dropdown in the inquiries list
                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'read' => 'Read',
                        'responsed' => 'Responsed',
                        'ignored' => 'Ignored',
                    ])
                    ->selectablePlaceholder(false),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'read' => 'Read',
                        'responsed' => 'Responsed',
                        'ignored' => 'Ignored',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('warning')
                    ->visible(fn (ContactInquiry $record): bool => !empty($record->attachment_path))
                    ->url(fn (ContactInquiry $record): string => Storage::disk('public')->url($record->attachment_path))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->label('Edit Status'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactInquiries::route('/'),
            'edit' => Pages\EditContactInquiry::route('/{record}/edit'),
        ];
    }
}
