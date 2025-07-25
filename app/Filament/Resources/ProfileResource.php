<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->rows(4)
                    ->maxLength(1000)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('avatar_url')
                    ->label('Profile Picture')
                    ->image()
                    ->directory('avatars')
                    ->disk('public')
                    ->imageEditor()
                    ->circleCropper()
                    ->columnSpanFull(),
                Forms\Components\Fieldset::make('Social Links')
                    ->schema([
                        Forms\Components\TextInput::make('website_url')
                            ->url()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-globe-alt')
                            ->placeholder('https://yourwebsite.com'),
                        Forms\Components\TextInput::make('linkedin_url')
                            ->url()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user-group')
                            ->placeholder('https://linkedin.com/in/username'),
                        Forms\Components\TextInput::make('github_url')
                            ->url()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-code-bracket')
                            ->placeholder('https://github.com/username'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar_url')
                    ->label('Picture')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\IconColumn::make('linkedin_url')
                    ->label('LinkedIn')
                    ->icon('heroicon-o-link')
                    ->url(fn($record) => $record->linkedin_url)
                    ->openUrlInNewTab(),
                Tables\Columns\IconColumn::make('github_url')
                    ->label('GitHub')
                    ->icon('heroicon-o-link')
                    ->url(fn($record) => $record->github_url)
                    ->openUrlInNewTab(),
                Tables\Columns\IconColumn::make('website_url')
                    ->label('Website')
                    ->icon('heroicon-o-link')
                    ->url(fn($record) => $record->website_url)
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
