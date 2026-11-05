<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Solutions & Systems';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required(),
                Forms\Components\TextInput::make('subtitle'),
                Forms\Components\TextInput::make('badge')
                    ->label('Card Badge / Tag')
                    ->placeholder('e.g. ETFE & PTFE, Stadia & Arenas'),

                Forms\Components\Placeholder::make('current_hero_image_preview')
                    ->label('Current Hero Image')
                    ->content(fn ($record) => $record && $record->image_url
                        ? new HtmlString('<div style="display:flex;align-items:center;gap:14px;padding:6px 0;"><img src="' . $record->image_url . '" alt="Current Hero Image" style="max-height: 120px; max-width: 220px; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.1); object-fit: cover;"><span style="color:#64748b;font-size:0.875rem;">Currently saved image. Will be retained if no new file is uploaded below.</span></div>')
                        : 'No hero image set yet')
                    ->visible(fn ($record) => !empty($record?->hero_image))
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('hero_image')
                    ->label(fn ($record) => $record && $record->hero_image ? 'Replace Hero Image' : 'Hero Image')
                    ->image()
                    ->directory('services')
                    ->visibility('public')
                    ->nullable()
                    ->dehydrated(fn ($state) => filled($state))
                    ->helperText('Upload a new image to replace the current one. Leave empty to keep the current image intact.')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('icon_name'),
                Forms\Components\TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active on Website')
                    ->default(true),
                Forms\Components\Textarea::make('summary')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('technical_specs')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active'),
                Tables\Columns\ImageColumn::make('hero_image')
                    ->label('Image')
                    ->getStateUsing(fn ($record) => $record->image_url),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('badge')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
                //
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
