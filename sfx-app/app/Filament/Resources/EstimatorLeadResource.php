<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EstimatorLeadResource\Pages;
use App\Filament\Resources\EstimatorLeadResource\RelationManagers;
use App\Models\EstimatorLead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EstimatorLeadResource extends Resource
{
    protected static ?string $model = EstimatorLead::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationGroup = 'Inquiries & Leads';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('structure_type')
                    ->required(),
                Forms\Components\TextInput::make('footprint_area')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('membrane_choice')
                    ->required(),
                Forms\Components\TextInput::make('calculated_tonnage')
                    ->numeric(),
                Forms\Components\TextInput::make('estimated_weeks'),
                Forms\Components\TextInput::make('client_name')
                    ->required(),
                Forms\Components\TextInput::make('client_email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('client_phone')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('company_name'),
                Forms\Components\TextInput::make('project_location'),
                Forms\Components\Textarea::make('additional_notes')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('structure_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('footprint_area')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('membrane_choice')
                    ->searchable(),
                Tables\Columns\TextColumn::make('calculated_tonnage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimated_weeks')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
            'index' => Pages\ListEstimatorLeads::route('/'),
            'create' => Pages\CreateEstimatorLead::route('/create'),
            'edit' => Pages\EditEstimatorLead::route('/{record}/edit'),
        ];
    }
}
