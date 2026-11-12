<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use App\Models\ServiceMedia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    protected static ?string $title = 'Solution Media Gallery (Photos & Videos)';

    protected static ?string $icon = 'heroicon-o-film';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Radio::make('media_type')
                    ->label('Media Type')
                    ->options([
                        'image' => 'Photo (JPG, PNG, WebP)',
                        'video' => 'Video (MP4, WebM, QuickTime or YouTube/Vimeo Embed)',
                    ])
                    ->default('image')
                    ->inline()
                    ->live()
                    ->required()
                    ->columnSpanFull(),

                // Current Preview (on edit)
                Forms\Components\Placeholder::make('current_preview')
                    ->label('Current Media Preview')
                    ->content(function ($record) {
                        if (!$record) return 'No media saved yet';
                        if ($record->is_video) {
                            if (!empty($record->external_url) && $record->embed_url) {
                                return new HtmlString('<div style="max-width: 320px; aspect-ratio: 16/9;"><iframe src="' . e($record->embed_url) . '" style="width: 100%; height: 100%; border-radius: 8px; border: 1px solid #cbd5e1;" allowfullscreen></iframe></div>');
                            }
                            return new HtmlString('<div style="max-width: 320px;"><video src="' . e($record->media_url) . '" controls style="max-height: 140px; border-radius: 8px; border: 1px solid #cbd5e1;"></video></div>');
                        }
                        return new HtmlString('<div style="display:flex;align-items:center;gap:14px;"><img src="' . e($record->media_url) . '" alt="' . e($record->caption ?? 'Gallery Image') . '" style="max-height: 140px; max-width: 240px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.1); object-fit: cover;"></div>');
                    })
                    ->visible(fn ($record) => !empty($record?->file_path) || !empty($record?->external_url))
                    ->columnSpanFull(),

                // File Upload (for Images)
                Forms\Components\FileUpload::make('file_path')
                    ->label(fn ($record) => $record && $record->file_path ? 'Replace Image File' : 'Upload Image File')
                    ->image()
                    ->directory('services/gallery')
                    ->visibility('public')
                    ->required(fn (string $context, Get $get): bool => $context === 'create' && $get('media_type') === 'image')
                    ->visible(fn (Get $get) => $get('media_type') === 'image')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Upload an architectural photograph (JPG, PNG, WebP).')
                    ->columnSpanFull(),

                // File Upload (for Local Video Files)
                Forms\Components\FileUpload::make('video_file')
                    ->label(fn ($record) => $record && $record->file_path && $record->is_video ? 'Replace Video File' : 'Upload Local Video File (MP4, WebM, MOV)')
                    ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime', 'video/ogg'])
                    ->maxSize(102400) // 100MB
                    ->directory('services/videos')
                    ->visibility('public')
                    ->visible(fn (Get $get) => $get('media_type') === 'video')
                    ->dehydrated(false)
                    ->afterStateHydrated(function (Forms\Components\FileUpload $component, $record) {
                        if ($record && $record->is_video && !empty($record->file_path)) {
                            $component->state($record->file_path);
                        }
                    })
                    ->helperText('Upload an MP4 or WebM video file (Max 100MB).')
                    ->columnSpanFull(),

                // External Video URL (for YouTube, Vimeo, or direct CDN links)
                Forms\Components\TextInput::make('external_url')
                    ->label('Or External Video URL (YouTube, Vimeo, or CDN link)')
                    ->url()
                    ->placeholder('https://www.youtube.com/watch?v=... or https://vimeo.com/...')
                    ->visible(fn (Get $get) => $get('media_type') === 'video')
                    ->helperText('Provide a YouTube or Vimeo link if you prefer streaming over uploading a local video file.')
                    ->columnSpanFull(),

                // Caption
                Forms\Components\TextInput::make('caption')
                    ->label('Media Caption / Angle Description')
                    ->placeholder('e.g. Under-canopy diffused daylight view, Mast tensioning detail, Inflation timelapse')
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Sort Order
                Forms\Components\TextInput::make('sort_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(fn ($livewire) => ($livewire->getOwnerRecord()->media()->max('sort_order') ?? 0) + 1)
                    ->helperText('Lower numbers appear first in the gallery strip and showcase.')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('media_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'video' ? '🎥 Video' : '🖼️ Photo')
                    ->color(fn ($state) => $state === 'video' ? 'warning' : 'success')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Preview')
                    ->getStateUsing(fn ($record) => $record->thumbnail_url)
                    ->size(75),

                Tables\Columns\TextColumn::make('caption')
                    ->label('Caption / Title')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No caption set'),

                Tables\Columns\TextColumn::make('file_path')
                    ->label('Source / Path')
                    ->getStateUsing(fn ($record) => $record->external_url ? 'External: ' . $record->external_url : $record->file_path)
                    ->color('gray')
                    ->limit(40),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Media Item')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add New Photo or Video')
                    ->mutateFormDataUsing(function (array $data): array {
                        // If video file was uploaded, map it to file_path
                        if ($data['media_type'] === 'video' && !empty($data['video_file'])) {
                            $data['file_path'] = $data['video_file'];
                        }
                        unset($data['video_file']);
                        return $data;
                    }),

                Tables\Actions\Action::make('upload_multiple_photos')
                    ->label('Batch Upload Photos')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('primary')
                    ->modalHeading('Batch Upload Multiple Photos')
                    ->modalDescription('Select multiple architectural photos at once (JPG, PNG, WebP) to append to this solution\'s gallery.')
                    ->form([
                        Forms\Components\FileUpload::make('photos')
                            ->label('Select Photos')
                            ->multiple()
                            ->image()
                            ->directory('services/gallery')
                            ->visibility('public')
                            ->required()
                            ->helperText('You can select and upload multiple image files simultaneously.'),
                    ])
                    ->action(function (array $data): void {
                        $service = $this->getOwnerRecord();
                        $currentMaxOrder = $service->media()->max('sort_order') ?? 0;
                        $uploadedCount = 0;

                        foreach ($data['photos'] as $path) {
                            $currentMaxOrder++;
                            $filename = pathinfo($path, PATHINFO_FILENAME);
                            $cleanCaption = ucwords(str_replace(['-', '_'], ' ', $filename));

                            ServiceMedia::create([
                                'service_id' => $service->id,
                                'media_type' => 'image',
                                'file_path' => $path,
                                'caption' => $cleanCaption,
                                'sort_order' => $currentMaxOrder,
                            ]);
                            $uploadedCount++;
                        }

                        Notification::make()
                            ->title("Successfully added {$uploadedCount} photos to the gallery")
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('upload_multiple_videos')
                    ->label('Batch Upload Videos')
                    ->icon('heroicon-o-video-camera')
                    ->color('warning')
                    ->modalHeading('Batch Upload Multiple Videos')
                    ->modalDescription('Select video clips (MP4, WebM, MOV) to append to this solution\'s gallery.')
                    ->form([
                        Forms\Components\FileUpload::make('videos')
                            ->label('Select Video Files')
                            ->multiple()
                            ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime', 'video/ogg'])
                            ->maxSize(102400)
                            ->directory('services/videos')
                            ->visibility('public')
                            ->required()
                            ->helperText('Upload MP4 or WebM video reels / construction timelapses.'),
                    ])
                    ->action(function (array $data): void {
                        $service = $this->getOwnerRecord();
                        $currentMaxOrder = $service->media()->max('sort_order') ?? 0;
                        $uploadedCount = 0;

                        foreach ($data['videos'] as $path) {
                            $currentMaxOrder++;
                            $filename = pathinfo($path, PATHINFO_FILENAME);
                            $cleanCaption = ucwords(str_replace(['-', '_'], ' ', $filename)) . ' (Video)';

                            ServiceMedia::create([
                                'service_id' => $service->id,
                                'media_type' => 'video',
                                'file_path' => $path,
                                'caption' => $cleanCaption,
                                'sort_order' => $currentMaxOrder,
                            ]);
                            $uploadedCount++;
                        }

                        Notification::make()
                            ->title("Successfully added {$uploadedCount} videos to the gallery")
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        if ($data['media_type'] === 'video' && !empty($data['video_file'])) {
                            $data['file_path'] = $data['video_file'];
                        }
                        unset($data['video_file']);
                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
