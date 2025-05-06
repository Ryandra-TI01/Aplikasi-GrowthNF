<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommunityResource\Pages;
use App\Filament\Resources\CommunityResource\RelationManagers;
use App\Models\Community;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Community Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('skill_id')
                    ->relationship('skill', 'name')
                    ->label('Skill Name')
                    ->required(),
                Forms\Components\Select::make('platform')
                    ->options([
                        'wa' => 'WhatsApp',
                        'telegram' => 'Telegram',
                        'discord' => 'Discord',
                    ])
                    ->label('Platform')
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label('Link Platform')
                    ->prefix('https://')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Community Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skill.name')
                    ->label('Skill Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('platform')
                    ->searchable()
                    ->label('Platform'),
                Tables\Columns\TextColumn::make('link')
                    ->label('Link Platform')
                    ->prefix('https://')
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
            'index' => Pages\ListCommunities::route('/'),
            'create' => Pages\CreateCommunity::route('/create'),
            'edit' => Pages\EditCommunity::route('/{record}/edit'),
        ];
    }
}
