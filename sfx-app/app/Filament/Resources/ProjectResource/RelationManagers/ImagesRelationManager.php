<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\ProjectImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Project Photo Gallery';

    protected static ?string $icon = 'heroicon-o-photo';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Placeholder::make('current_image_preview')
                    ->label('Current Gallery Photo')
                    ->content(fn ($record) => $record && $record->image_url
                        ? new HtmlString('<div style="display:flex;align-items:center;gap:14px;padding:6px 0;"><img src="' . $record->image_url . '" alt="' . e($record->caption ?? 'Gallery Image') . '" style="max-height: 140px; max-width: 240px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.1); object-fit: cover;"><span style="color:#64748b;font-size:0.875rem;">Currently saved image. Will be retained if no new file is uploaded below.</span></div>')
                        : 'No image uploaded yet')
                    ->visible(fn ($record) => !empty($record?->image_path))
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('image_path')
                    ->label(fn ($record) => $record && $record->image_path ? 'Replace Image' : 'Gallery Image')
                    ->image()
                    ->directory('projects/gallery')
                    ->visibility('public')
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Upload an architectural photograph for this project (JPG, PNG, WebP).')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('caption')
                    ->label('Photo Caption / Angle Description')
                    ->placeholder('e.g. Under-canopy diffused daylight view, Mast connection detail')
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('sort_order')
                    ->label('Display Order')
                    ->numeric()
                    ->default(fn ($livewire) => ($livewire->getOwnerRecord()->images()->max('sort_order') ?? 0) + 1)
                    ->helperText('Lower numbers appear first in the photo gallery strip and modal.')
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
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Photo')
                    ->getStateUsing(fn ($record) => $record->image_url)
                    ->size(75),

                Tables\Columns\TextColumn::make('caption')
                    ->label('Caption / Angle')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No caption set'),

                Tables\Columns\TextColumn::make('image_path')
                    ->label('Storage Path')
                    ->color('gray')
                    ->limit(45),

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
                    ->label('Add Single Photo')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Add New Project Gallery Photo'),

                Tables\Actions\Action::make('upload_multiple')
                    ->label('Upload Multiple Photos')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('primary')
                    ->modalHeading('Batch Upload Gallery Photos')
                    ->modalDescription('Select multiple images to upload at once. They will be added to this project\'s gallery.')
                    ->form([
                        Forms\Components\FileUpload::make('gallery_files')
                            ->label('Select Photos')
                            ->multiple()
                            ->image()
                            ->directory('projects/gallery')
                            ->visibility('public')
                            ->required()
                            ->helperText('You can select multiple JPG, PNG, or WebP files at once.')
                            ->columnSpanFull(),
                    ])
                    ->action(function (array $data) {
                        $project = $this->getOwnerRecord();
                        $currentMax = $project->images()->max('sort_order') ?? 0;
                        $files = $data['gallery_files'] ?? [];
                        $count = 0;

                        foreach ($files as $filePath) {
                            $currentMax++;
                            $count++;
                            $project->images()->create([
                                'image_path' => $filePath,
                                'caption' => null,
                                'sort_order' => $currentMax,
                            ]);
                        }

                        Notification::make()
                            ->title("Successfully added {$count} gallery photo(s)")
                            ->success()
                            ->send();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
