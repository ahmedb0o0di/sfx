<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Knowledge & Insights';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\TextInput::make('category')
                    ->required(),
                Forms\Components\Textarea::make('excerpt')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('current_featured_image_preview')
                    ->label('Current Featured Image')
                    ->content(fn ($record) => $record && $record->image_url
                        ? new HtmlString('<div style="display:flex;align-items:center;gap:14px;padding:6px 0;"><img src="' . $record->image_url . '" alt="Current Featured Image" style="max-height: 120px; max-width: 220px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.1); object-fit: cover;"><span style="color:#64748b;font-size:0.875rem;">Currently saved image. Will be retained if no new file is uploaded below.</span></div>')
                        : 'No image set yet')
                    ->visible(fn ($record) => !empty($record?->featured_image))
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('featured_image')
                    ->label(fn ($record) => $record && $record->featured_image ? 'Replace Featured Image' : 'Featured Image')
                    ->image()
                    ->directory('posts')
                    ->visibility('public')
                    ->nullable()
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Upload a new image to replace the current one. Leave empty to keep the current image intact.')
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('current_video_preview')
                    ->label('Current Video')
                    ->content(fn ($record) => $record && $record->video_url
                        ? new HtmlString('<div style="display:flex;flex-direction:column;gap:8px;padding:6px 0;"><video src="' . $record->video_url . '" controls style="max-height: 200px; max-width: 360px; border-radius: 8px; border: 1px solid #cbd5e1; background: #000;"></video><span style="color:#64748b;font-size:0.875rem;">Currently saved video. Leave empty below to keep this video intact.</span></div>')
                        : 'No video uploaded')
                    ->visible(fn ($record) => !empty($record?->video_path))
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('video_path')
                    ->label(fn ($record) => $record && $record->video_path ? 'Replace Video (Optional)' : 'Video (Optional)')
                    ->acceptedFileTypes(['video/*', 'video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'])
                    ->maxSize(102400) // 100MB
                    ->directory('posts/videos')
                    ->visibility('public')
                    ->nullable()
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Upload an MP4 or WebM video for this post (optional). Not mandatory. Max size: 100MB.')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('author')
                    ->required(),
                Forms\Components\TextInput::make('reading_time_minutes')
                    ->required()
                    ->numeric()
                    ->default(5),
                Forms\Components\Checkbox::make('status')
                    ->label('Published')
                    ->helperText('Check to publish on website, or uncheck for draft.')
                    ->formatStateUsing(fn ($state): bool => $state === 'published')
                    ->dehydrateStateUsing(fn ($state): string => !empty($state) ? 'published' : 'draft')
                    ->default(true),
                Forms\Components\DateTimePicker::make('published_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Image')
                    ->getStateUsing(fn ($record) => $record->image_url),
                Tables\Columns\IconColumn::make('video_path')
                    ->label('Video')
                    ->boolean()
                    ->getStateUsing(fn ($record): bool => !empty($record->video_path)),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author')
                    ->searchable(),
                Tables\Columns\TextColumn::make('reading_time_minutes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Published')
                    ->getStateUsing(fn ($record): bool => $record->status === 'published')
                    ->updateStateUsing(function ($record, $state) {
                        $record->status = !empty($state) ? 'published' : 'draft';
                        $record->save();
                        return $record->status;
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'published' => 'Published',
                        'draft' => 'Draft',
                    ]),
            ])
            ->actions([
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
