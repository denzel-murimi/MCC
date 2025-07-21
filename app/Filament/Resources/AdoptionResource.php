<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdoptionResource\Pages;
use App\Filament\Resources\AdoptionResource\RelationManagers\TransactionsRelationManager;
use App\Models\Adoption;
use App\Support\Facade\Hashids;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdoptionResource extends Resource
{
    protected static ?string $model = Adoption::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Finances';

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()->required(),
                Forms\Components\TextInput::make('currency')
                    ->default('KES'),
                Forms\Components\TextInput::make('reference'),
                Forms\Components\TextInput::make('status'),
                Forms\Components\KeyValue::make('metadata'),
                Forms\Components\TextInput::make('child_id')->numeric(),
                Forms\Components\TextInput::make('contribution_type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contribution_type')
                    ->sortable()
                    ->badge()
                    ->label('Type')
                    ->color(fn (string $state): string => match ($state) {
                    'recurring' => 'warning',
                    'one-time' => 'success',
                    })->formatStateUsing(fn (string $state): string => strtoupper($state)),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('child.name')->searchable()->label('Child Name'),
                Tables\Columns\TextColumn::make('amount')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'primary',
                        'completed' => 'success',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdoptions::route('/'),
            'create' => Pages\CreateAdoption::route('/create'),
            'edit' => Pages\EditAdoption::route('/{record}/edit'),
            'view' => Pages\ViewAdoption::route('/{record}'),
        ];
    }

    public static function resolveRecordRouteBinding(int|string $key): ?Model
    {
        $decoded = Hashids::decode($key);

        if (!isset($decoded[0])) {
            throw (new ModelNotFoundException)->setModel(Adoption::class);
        }

        return Adoption::findOrFail($decoded[0]);
    }
}
