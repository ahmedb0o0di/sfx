<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Practice & Opportunities';

    protected static ?string $navigationLabel = 'Career Openings';

    protected static ?string $modelLabel = 'Career Opportunity';

    protected static ?string $pluralModelLabel = 'Career Openings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Position Overview')
                    ->description('Define the job role title, discipline, location, and active status.')
                    ->icon('heroicon-o-identification')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Job Position Title *')
                                ->required()
                                ->placeholder('e.g. Senior Tensile Structural Engineer')
                                ->columnSpan(8),

                            Forms\Components\TextInput::make('department')
                                ->label('Department / Practice')
                                ->placeholder('e.g. Structural Engineering & FEA')
                                ->default('Structural Engineering')
                                ->columnSpan(4),

                            Forms\Components\TextInput::make('location')
                                ->label('Office / Site Location')
                                ->placeholder('e.g. Dubai Regional HQ')
                                ->default('Dubai Regional HQ')
                                ->columnSpan(4),

                            Forms\Components\TextInput::make('type')
                                ->label('Employment Type')
                                ->placeholder('e.g. Full-time / Permanent')
                                ->default('Full-time')
                                ->columnSpan(4),

                            Forms\Components\TextInput::make('sort_order')
                                ->label('Sort Order')
                                ->numeric()
                                ->default(0)
                                ->columnSpan(2),

                            Forms\Components\Toggle::make('is_active')
                                ->label('Active / Visible on Website')
                                ->default(true)
                                ->inline(false)
                                ->columnSpan(2),
                        ]),
                    ]),

                Section::make('Job Media & Application Details')
                    ->description('Set role illustration image, complete job description, and application button destination link.')
                    ->icon('heroicon-o-document-text')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label('Job Image / Thumbnail')
                                ->image()
                                ->directory('careers')
                                ->helperText('Upload a role visual or site photo. If left empty, default practice visual will be used.')
                                ->columnSpan(6),

                            Forms\Components\TextInput::make('apply_url')
                                ->label('Application URL / Link to Apply *')
                                ->placeholder('/contact?inquiry=careers&role=Position-Title')
                                ->helperText('Link to the contact form with pre-filled role, or an external applicant tracking URL.')
                                ->default('/contact?inquiry=careers')
                                ->required()
                                ->columnSpan(6),

                            Forms\Components\Textarea::make('description')
                                ->label('Job Description & Responsibilities *')
                                ->placeholder('Describe key requirements, computational tools, and landmark project scope...')
                                ->rows(5)
                                ->required()
                                ->columnSpan(12),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Thumbnail')
                    ->circular(false)
                    ->height(46)
                    ->width(70),

                Tables\Columns\TextColumn::make('title')
                    ->label('Position Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('department')
                    ->label('Department')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
