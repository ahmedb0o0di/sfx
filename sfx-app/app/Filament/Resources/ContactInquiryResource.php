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

class ContactInquiryResource extends Resource
{
    protected static ?string $model = ContactInquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Inquiries & Leads';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Inquiry Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New / Unread',
                                'contacted' => 'Contacted Client',
                                'in_review' => 'Engineering Review',
                                'quoted' => 'Tender Quoted',
                                'closed' => 'Closed',
                            ])
                            ->required()
                            ->default('new'),
                        Forms\Components\TextInput::make('subject')
                            ->required()
                            ->columnSpanFull()
                            ->disabled(),
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull()
                            ->disabled(),
                    ])->columns(2),

                Forms\Components\Section::make('Architectural Drawings & RFP Attachment')
                    ->schema([
                        Forms\Components\FileUpload::make('attachment_path')
                            ->label('Attached CAD / PDF / Specifications Document')
                            ->disk('public')
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->columnSpanFull(),
                    ]),
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
                    ->limit(35),
                Tables\Columns\IconColumn::make('attachment_path')
                    ->label('Attachment')
                    ->boolean()
                    ->state(fn (ContactInquiry $record): bool => !empty($record->attachment_path))
                    ->trueIcon('heroicon-o-paper-clip')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('primary')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'info',
                        'in_review' => 'warning',
                        'quoted' => 'success',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'in_review' => 'In Review',
                        'quoted' => 'Quoted',
                        'closed' => 'Closed',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download File')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->visible(fn (ContactInquiry $record): bool => !empty($record->attachment_path) && Storage::disk('public')->exists($record->attachment_path))
                    ->action(function (ContactInquiry $record) {
                        return Storage::disk('public')->download($record->attachment_path);
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'create' => Pages\CreateContactInquiry::route('/create'),
            'edit' => Pages\EditContactInquiry::route('/{record}/edit'),
        ];
    }
}
