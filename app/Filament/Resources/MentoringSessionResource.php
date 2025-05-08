<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentoringSessionResource\Pages;
use App\Filament\Resources\MentoringSessionResource\RelationManagers;
use App\Models\MentoringSession;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MentoringSessionResource extends Resource
{
    protected static ?string $model = MentoringSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

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
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Mentoring Session Title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Mentoring Session Description')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('scheduled_at')
                    ->label('Scheduled At')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('proof_image')
                    ->label('Proof Image')
                    ->image(),
                Forms\Components\TextInput::make('group_link')
                    ->label('Group Link')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mentor.name')
                    ->label('Mentor Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Mentoring Session Title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('scheduled_at')
                    ->label('Scheduled At')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'warning',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->badge(),
                Tables\Columns\ImageColumn::make('proof_image')
                    ->label('Proof Image')
                    ->circular(),
                Tables\Columns\TextColumn::make('group_link')
                    ->copyable()
                    ->copyableState(fn (string $state): string => "URL: {$state}")
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
            'index' => Pages\ListMentoringSessions::route('/'),
            'create' => Pages\CreateMentoringSession::route('/create'),
            'edit' => Pages\EditMentoringSession::route('/{record}/edit'),
        ];
    }
}
