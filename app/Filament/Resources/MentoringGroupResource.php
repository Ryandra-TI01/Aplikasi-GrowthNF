<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentoringGroupResource\Pages;
use App\Filament\Resources\MentoringGroupResource\RelationManagers;
use App\Models\MentoringGroup;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MentoringGroupResource extends Resource
{
    protected static ?string $model = MentoringGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mentor_id')
                ->label('Mentor Name')
                    ->options(
                        User::where('role', 'mentor')
                            ->where('is_verified', true)
                            ->pluck('name', 'id')       
                    )
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Mentoring Group Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('platform')
                    ->label('Group Platform')
                    ->options([
                        'wa' => 'WhatsApp',
                        'telegram' => 'Telegram',
                        'discord' => 'Discord',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label('Group Link')
                    ->url()
                    ->prefix('https://')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mentor.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Mentoring Group Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('platform')
                    ->label('Group Platform')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'wa' => 'success',
                        'telegram' => 'warning',
                        'discord' => 'danger',
                    })
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->label('Group Link')
                    ->limit(30)
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
            'index' => Pages\ListMentoringGroups::route('/'),
            'create' => Pages\CreateMentoringGroup::route('/create'),
            'edit' => Pages\EditMentoringGroup::route('/{record}/edit'),
        ];
    }
}
