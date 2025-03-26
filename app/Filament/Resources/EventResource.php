<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\ColorPicker::make('colour')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_at')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_at')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('recurrence_type')
                    ->options([
                        'none' => 'No Recurrence',
                        'daily' => 'Daily',
                        'weekly' => 'Weekly',
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly'
                    ])
                    ->default('none')
                    ->live(),

                Forms\Components\Group::make()
                    ->schema(fn($get) => match ($get('recurrence_type')) {
                        'daily' => [
                            Forms\Components\TextInput::make('recurrence_interval')
                                ->label('Repeat Every (Days)')
                                ->numeric()
                                ->default(1)
                                ->minValue(1),
                            Forms\Components\DatePicker::make('recurrence_end_date')
                                ->label('End Recurrence')
                        ],
                        'weekly' => [
                            Forms\Components\TextInput::make('recurrence_interval')
                                ->label('Repeat Every (Weeks)')
                                ->numeric()
                                ->default(1)
                                ->minValue(1),
                            Forms\Components\CheckboxList::make('recurrence_days')
                                ->label('Days of Week')
                                ->options([
                                    'MO' => 'Monday',
                                    'TU' => 'Tuesday',
                                    'WE' => 'Wednesday',
                                    'TH' => 'Thursday',
                                    'FR' => 'Friday',
                                    'SA' => 'Saturday',
                                    'SU' => 'Sunday'
                                ]),
                            Forms\Components\DatePicker::make('recurrence_end_date')
                                ->label('End Recurrence')
                        ],
                        'monthly' => [
                            Forms\Components\TextInput::make('recurrence_interval')
                                ->label('Repeat Every (Months)')
                                ->numeric()
                                ->default(1)
                                ->minValue(1),
                            Forms\Components\Select::make('monthly_recurrence_type')
                                ->options([
                                    'day_of_month' => 'On specific day of month',
                                    'nth_day_of_week' => 'On nth day of week'
                                ]),
                            Forms\Components\DatePicker::make('recurrence_end_date')
                                ->label('End Recurrence')
                        ],
                        'yearly' => [
                            Forms\Components\TextInput::make('recurrence_interval')
                                ->label('Repeat Every (Years)')
                                ->numeric()
                                ->default(1)
                                ->minValue(1),
                            Forms\Components\DatePicker::make('recurrence_end_date')
                                ->label('End Recurrence')
                        ],
                        default => []
                    })->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ColorColumn::make('colour')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('recurrence_type'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
