<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Portfolio & Architecture';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name'),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required(),
                Forms\Components\TextInput::make('client_name'),
                Forms\Components\TextInput::make('covered_area'),
                Forms\Components\TextInput::make('membrane_material'),
                Forms\Components\TextInput::make('year_completed')
                    ->numeric(),
                Forms\Components\Textarea::make('short_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('full_overview')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('structural_challenge')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('engineering_solution')
                    ->columnSpanFull(),

                Forms\Components\Placeholder::make('current_thumbnail_preview')
                    ->label('Current Thumbnail')
                    ->content(fn ($record) => $record && $record->image_url
                        ? new HtmlString('<div style="display:flex;align-items:center;gap:14px;padding:6px 0;"><img src="' . $record->image_url . '" alt="Current Thumbnail" style="max-height: 120px; max-width: 220px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.1); object-fit: cover;"><span style="color:#64748b;font-size:0.875rem;">Currently saved image. Will be retained if no new file is uploaded below.</span></div>')
                        : 'No thumbnail set yet')
                    ->visible(fn ($record) => !empty($record?->thumbnail_image))
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('thumbnail_image')
                    ->label(fn ($record) => $record && $record->thumbnail_image ? 'Replace Thumbnail Image' : 'Thumbnail Image')
                    ->image()
                    ->directory('projects')
                    ->visibility('public')
                    ->nullable()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Upload a new image to replace the current one. Leave empty to keep the current image intact.')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\Checkbox::make('status')
                    ->label('Published')
                    ->helperText('Check to publish on website, or uncheck for draft.')
                    ->formatStateUsing(fn ($state): bool => $state === 'published')
                    ->dehydrateStateUsing(fn ($state): string => !empty($state) ? 'published' : 'draft')
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_image')
                    ->label('Thumbnail')
                    ->getStateUsing(fn ($record) => $record->image_url),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('covered_area')
                    ->searchable(),
                Tables\Columns\TextColumn::make('membrane_material')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year_completed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Published')
                    ->getStateUsing(fn ($record): bool => $record->status === 'published')
                    ->updateStateUsing(function ($record, $state) {
                        $record->status = !empty($state) ? 'published' : 'draft';
                        $record->save();
                        return $record->status;
                    }),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
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
            ])
            ->defaultPaginationPageOption(25)
            ->paginationPageOptions([10, 25, 50, 'all']);
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
