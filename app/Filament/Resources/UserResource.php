<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Full Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state)) // Hanya di-hash jika diisi
                    ->password()
                    ->maxLength(255),
                Forms\Components\Select::make('role')

                    ->options([
                        'admin'=> 'Admin',
                        'mentor' => 'Mentor', 
                        'mahasiswa'=> 'Mahasiswa',
                    ])
                    ->label('Role')
                    ->required(),
                Forms\Components\Textarea::make('bio')
                    ->label('Bio')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('photo')
                    ->disk('public')
                    ->directory('users')
                    ->label('Photo')
                    ->image()
                    ->columnSpanFull()
                    ->imageEditor(),
                Forms\Components\MultiSelect::make('skills')
                    ->relationship('skills', 'name')
                    ->label('Skill')
                    ->placeholder('Choose skills')
                    ->preload()
                    
                    ->required(),
                Forms\Components\ToggleButtons::make('is_verified')
                    ->label('Verified Mentor?')
                    ->grouped()
                    ->boolean()
                    ->inline()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Full Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'mentor' => 'warning',
                        'mahasiswa' => 'success',
                    })
                    ->badge()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    
                    ->boolean(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
