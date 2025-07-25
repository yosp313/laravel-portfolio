<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Filament\Resources\ExperienceResource\RelationManagers;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\MarkdownColumn as TablesMarkdownColumn;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Job Title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->label('Company')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('start_year')
                    ->label('Start Year')
                    ->required()
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(2100)
                    ->helperText('Year you started this job.'),
                Forms\Components\TextInput::make('end_year')
                    ->label('End Year')
                    ->nullable()
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(2100)
                    ->helperText('Year you ended this job (leave blank if current).'),
                Forms\Components\MarkdownEditor::make('description')
                    ->label('Description')
                    ->maxLength(1000)
                    ->helperText('Supports Markdown. Describe your responsibilities and achievements.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Job Title')->searchable(),
                Tables\Columns\TextColumn::make('company')->label('Company')->searchable(),
                Tables\Columns\TextColumn::make('start_year')->label('Start'),
                Tables\Columns\TextColumn::make('end_year')->label('End'),
                Tables\Columns\TextColumn::make('description')->label('Description')->limit(40),
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
