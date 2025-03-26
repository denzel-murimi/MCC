<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use Carbon\Carbon;
use Saade\FilamentFullCalendar\Actions\CreateAction;
use Saade\FilamentFullCalendar\Actions\DeleteAction;
use Saade\FilamentFullCalendar\Actions\EditAction;
use Saade\FilamentFullCalendar\Actions\ViewAction;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Event::class;

    protected function headerActions(): array
    {
        return [
            CreateAction::make()
                ->mountUsing(
                    function(Form $form, array $arguments){
                        $form->fill([
                            'start_at' => $arguments['start'] ?? null,
                            'end_at' => $arguments['end'] ?? null,
                        ]);
                    }
                ),
        ];
    }

    protected function modalActions(): array
    {
        return [
            EditAction::make()
                ->mountUsing(
                    function(Event $event, Form $form, array $arguments){
                        $form->fill([
                            'title' => $event->title,
                            'colour' => $event->colour,
                            'start_at' => $arguments['event']['start'] ?? $event->start_at,
                            'end_at' => $arguments['event']['end'] ?? $event->end_at,
                            'description' => $event->description,
                            'recurrence_type' => $event->recurrence_type,
                            'recurrence_interval' => $event->recurrence_interval,
                            'recurrence_days' => $event->recurrence_days,
                            'monthly_recurrence_type' => $event->monthly_recurrence_type,
                            'recurrence_end_date' => $event->recurrence_end_date,
                        ]);
                    }
                ),
            DeleteAction::make(),
        ];
    }

    protected function viewAction(): Action
    {
        return ViewAction::make();
    }

    public function fetchEvents(array $info): array
    {
        // Parse start and end with Carbon to ensure consistent timezone handling
        $start = Carbon::parse($info['start']);
        $end = Carbon::parse($info['end']);

        // Fetch base events that might recur within the date range
        $baseEvents = Event::query()
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    // Events that start before or during the range
                    $q->where('start_at', '<=', $end)
                        // And have no end, or end after the start of the range
                        ->where(function ($sq) use ($start) {
                            $sq->whereNull('end_at')
                                ->orWhere('end_at', '>=', $start);
                        });
                })
                    // Include events with recurrence
                    ->orWhere('recurrence_type', '!=', 'none');
            })
            ->get();

        // Generate recurring events
        $recurringEvents = $baseEvents->flatMap(function ($event) use ($start, $end) {
            return $this->generateRecurringEvents($event, $start->toDateTimeString(), $end->toDateTimeString());
        });

        // Transform events for FullCalendar
        return $recurringEvents->map(function(Event $event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_at instanceof \DateTime
                    ? $event->start_at->format('Y-m-d\TH:i:s')
                    : $event->start_at,
                'end' => $event->end_at instanceof \DateTime
                    ? $event->end_at->format('Y-m-d\TH:i:s')
                    : $event->end_at,
                'color' => $event->colour,
            ];
        })->all();
    }

    private function generateRecurringEvents(Event $event, string $start, string $end): array
    {
        // If no recurrence, return the event as-is
        if ($event->recurrence_type === 'none') {
            $eventStart = Carbon::parse($event->start_at);
            $eventEnd = Carbon::parse($event->end_at);
            $rangeStart = Carbon::parse($start);
            $rangeEnd = Carbon::parse($end);

            if ($eventStart <= $rangeEnd && $eventEnd >= $rangeStart) {
                return [$event];
            }
            return [];
        }

        try {
            // Create recurrence rule
            $startDate = Carbon::parse($event->start_at);
            $ruleString = $this->buildRecurrenceRuleString($event, $start, $end);

            Log::info('Recurrence Rule String: ' . $ruleString);
            Log::info('Original Event Start: ' . $event->start_at);
            Log::info('Start Parameter: ' . $start);
            Log::info('End Parameter: ' . $end);

            $rule = new Rule($ruleString, $startDate);

            // Configure transformer
            $transformer = new ArrayTransformer();

            // Generate occurrences with more explicit parameters
            $occurrences = $transformer->transform(
                $rule
            );

            // Detailed logging of occurrences
            Log::info('Occurrence Count: ' . count($occurrences));

            foreach ($occurrences as $index => $occurrence) {
                Log::info("Occurrence {$index}: " . $occurrence->getStart()->format('Y-m-d H:i:s'));
                }

            // Transform occurrences into events
            $recurringEvents = $occurrences->map(function ($occurrence) use ($event) {
                $recurringEvent = clone $event;
                $recurringEvent->start_at = $occurrence->getStart();
                $recurringEvent->end_at = $occurrence->getEnd() ?? $occurrence->getStart();
                return $recurringEvent;
            })->toArray();

            Log::info('Generated Recurring Events Count: ' . count($recurringEvents));

            return $recurringEvents;
        } catch (\Exception $e) {
            Log::error('Recurring Event Generation Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return [];
        }
    }
    private function buildRecurrenceRuleString(Event $event, string $rangeStart, string $rangeEnd): string
    {
        // If no recurrence, return empty string
        if ($event->recurrence_type === 'none') {
            return '';
        }

        $ruleComponents = [
            'FREQ=' . strtoupper($event->recurrence_type)
        ];

        // Add interval (only if specified and greater than default)
        if ($event->recurrence_interval && $event->recurrence_interval > 1) {
            $ruleComponents[] = 'INTERVAL=' . $event->recurrence_interval;
        }

        // Handle specific recurrence types
        switch ($event->recurrence_type) {
            case 'weekly':
                // Add specific days for weekly recurrence
                if (!empty($event->recurrence_days)) {
                    $ruleComponents[] = 'BYDAY=' . implode(',', $event->recurrence_days);
                }
                break;

            case 'monthly':
                // Handle monthly recurrence based on selected type
                if ($event->monthly_recurrence_type === 'day_of_month') {
                    // Use the day of the month from the start date
                    $startDate = Carbon::parse($event->start_at);
                    $ruleComponents[] = 'BYMONTHDAY=' . $startDate->day;
                } elseif ($event->monthly_recurrence_type === 'nth_day_of_week') {
                    // Determine the nth occurrence of the day
                    $startDate = Carbon::parse($event->start_at);
                    $weekdayMap = [
                        'MO' => 'Monday',
                        'TU' => 'Tuesday',
                        'WE' => 'Wednesday',
                        'TH' => 'Thursday',
                        'FR' => 'Friday',
                        'SA' => 'Saturday',
                        'SU' => 'Sunday'
                    ];

                    // Calculate which week of the month the start date falls on
                    $nthWeek = ceil($startDate->day / 7);
                    $weekday = strtoupper(substr($startDate->format('D'), 0, 2));

                    $ruleComponents[] = "BYDAY={$nthWeek}{$weekday}";
                }
                break;
        }

        // Add end date if specified
        if ($event->recurrence_end_date) {
            $endDate = Carbon::parse($event->recurrence_end_date);
            $ruleComponents[] = 'UNTIL=' . $endDate->format('Ymd\THis\Z');
        } else {
            // Prevent infinite recurrence
            $ruleComponents[] = 'COUNT=50';
        }

        Log::warning("Rrule:", (array)implode(';', $ruleComponents));
        return implode(';', $ruleComponents);
    }
    public function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->required(),
            ColorPicker::make('colour')
                ->required(),
            DateTimePicker::make('start_at')
                ->required(),
            DateTimePicker::make('end_at')
                ->required(),
            RichEditor::make('description')
                ->required()
                ->columnSpanFull(),
            Select::make('recurrence_type')
                ->options([
                    'none' => 'No Recurrence',
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly'
                ])
                ->default('none')
                ->live(),

            Group::make()
                ->schema(fn($get) => match ($get('recurrence_type')) {
                    'daily' => [
                        TextInput::make('recurrence_interval')
                            ->label('Repeat Every (Days)')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                        DatePicker::make('recurrence_end_date')
                            ->label('End Recurrence')
                    ],
                    'weekly' => [
                        TextInput::make('recurrence_interval')
                            ->label('Repeat Every (Weeks)')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                        CheckboxList::make('recurrence_days')
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
                        DatePicker::make('recurrence_end_date')
                            ->label('End Recurrence')
                    ],
                    'monthly' => [
                        TextInput::make('recurrence_interval')
                            ->label('Repeat Every (Months)')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                        Select::make('monthly_recurrence_type')
                            ->options([
                                'day_of_month' => 'On specific day of month',
                                'nth_day_of_week' => 'On nth day of week'
                            ]),
                        DatePicker::make('recurrence_end_date')
                            ->label('End Recurrence')
                    ],
                    'yearly' => [
                        TextInput::make('recurrence_interval')
                            ->label('Repeat Every (Years)')
                            ->numeric()
                            ->default(1)
                            ->minValue(1),
                        DatePicker::make('recurrence_end_date')
                            ->label('End Recurrence')
                    ],
                    default => []
                })->columns(2),
        ];
    }
}
