<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Filament\Resources\DonationResource\Widgets\DonationStats;
use App\Filament\Widgets\CalendarWidget;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\AccountWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Donations';
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
                Forms\Components\TextInput::make('type')
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('reference'),
                Forms\Components\TextInput::make('description'),
                Forms\Components\TextInput::make('MerchantRequestID')
                    ->label('MerchantRequestID'),
                Forms\Components\TextInput::make('CheckoutRequestID')
                    ->label('CheckoutRequestID'),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\TextInput::make('ReceiptNumber'),
                Forms\Components\TextInput::make('TransactionDate'),
                Forms\Components\TextInput::make('ResultDesc'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MPESA' => 'success',
                        'PAYPAL' => 'info',
                        'BITCOIN' => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->default("NULL"),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->money(fn ($record) => strtoupper($record->currency))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Requested' => 'warning',
                        'Completed' => 'success',
                        'Failed' => 'danger',
                    }),
                TextColumn::make('ReceiptNumber')
                    ->searchable()
                    ->default("NULL"),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }
    public static function getWidgets(): array
    {
        return [
            DonationStats::class,
        ];
    }
}
