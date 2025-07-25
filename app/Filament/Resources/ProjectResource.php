<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\MarkdownEditor::make('description')->required()->label('Description')->helperText('Supports Markdown.'),
                Forms\Components\TextInput::make('image_url')->url()->label('Image URL'),
                Forms\Components\TextInput::make('github_url')->url()->label('GitHub URL')->placeholder('https://github.com/yourrepo'),
                Forms\Components\TextInput::make('live_url')->url()->label('Live URL')->placeholder('https://yourproject.com'),
                Forms\Components\Select::make('skills')
                    ->multiple()
                    ->relationship('skills', 'name')
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('image_url')->url(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')->label('Image')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->limit(40),
                Tables\Columns\TagsColumn::make('skills.name')->label('Skills'),
                Tables\Columns\TextColumn::make('github_url')->label('GitHub')->url(fn($record) => $record->github_url)->openUrlInNewTab()->limit(20),
                Tables\Columns\TextColumn::make('live_url')->label('Live')->url(fn($record) => $record->live_url)->openUrlInNewTab()->limit(20),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
