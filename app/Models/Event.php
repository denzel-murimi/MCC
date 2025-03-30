<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;
use Recurr\Exception\InvalidRRule;
use Recurr\Exception\InvalidWeekday;
use Recurr\Rule;
use Recurr\Transformer\ArrayTransformer;
use Recurr\Transformer\ArrayTransformerConfig;

class Event extends Model
{
    protected $guarded=[];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'recurrence_end_date' => 'date',
        'recurrence_days' => 'array'
    ];

    protected $appends = [
       'program_url'
    ];

    private function program(): HasMany
    {
        return $this->hasMany(Program::class);
    }
    public function getProgramUrlAttribute(): string|null
    {
        $first = $this->program()->first();
        if ($first) {
            return route("program.show", [$first->slug]);
        }
        return null;
    }

    public function generateRecurringEvents(string $start, string $end): array
    {
        // If no recurrence, return the single event if it falls within range
        if ($this->recurrence_type === 'none') {
            $eventStart = Carbon::parse($this->start_at);
            $eventEnd = Carbon::parse($this->end_at);
            $rangeStart = Carbon::parse($start);
            $rangeEnd = Carbon::parse($end);

            if ($eventStart <= $rangeEnd && $eventEnd >= $rangeStart) {
                return [$this->toFullCalendarFormat()];
            }
            return [];
        }

        try {
            // Generate recurrence rule
            $startDate = Carbon::parse($this->start_at);
            $ruleString = $this->buildRecurrenceRuleString($start, $end);
            $rule = new Rule($ruleString, $startDate);

            // Recurrence transformer
            $transformer = new ArrayTransformer();
            $occurrences = $transformer->transform($rule);

            // Convert occurrences into FullCalendar events
            $recurringEvents = [];
            foreach ($occurrences as $index => $occurrence) {
                $eventCopy = clone $this;
                $eventCopy->start_at = Carbon::parse($occurrence->getStart());
                $eventCopy->end_at = Carbon::parse($occurrence->getEnd() ?? $occurrence->getStart());
                $eventCopy->id = $this->id . '-recurring-' . $index; // Ensure unique ID

                $recurringEvents[] = $eventCopy->toFullCalendarFormat();
            }

            Log::info('Generated ' . count($recurringEvents) . ' recurring events.');

            return $recurringEvents;
        } catch (\Exception $e) {
            Log::error('Recurring Event Generation Error: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Convert event to FullCalendar format
     */
    public function toFullCalendarFormat(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => Carbon::parse($this->start_at)->toIso8601String(),
            'end' => Carbon::parse($this->end_at)->toIso8601String(),
            'colour' => $this->colour,
            'allDay' => $this->all_day ?? false,
            'recurring' => $this->recurrence_type !== 'none',
            'url' => $this->program_url,
        ];
    }

    /**
     * Build RRULE for recurring events
     */
    private function buildRecurrenceRuleString(string $rangeStart, string $rangeEnd): string
    {
        if ($this->recurrence_type === 'none') return '';

        $ruleComponents = ['FREQ=' . strtoupper($this->recurrence_type)];

        if ($this->recurrence_interval && $this->recurrence_interval > 1) {
            $ruleComponents[] = 'INTERVAL=' . $this->recurrence_interval;
        }

        if ($this->recurrence_type === 'weekly' && !empty($this->recurrence_days)) {
            $ruleComponents[] = 'BYDAY=' . implode(',', $this->recurrence_days);
        }

        if ($this->recurrence_type === 'monthly') {
            $startDate = Carbon::parse($this->start_at);
            if ($this->monthly_recurrence_type === 'day_of_month') {
                $ruleComponents[] = 'BYMONTHDAY=' . $startDate->day;
            } elseif ($this->monthly_recurrence_type === 'nth_day_of_week') {
                $nthWeek = ceil($startDate->day / 7);
                $weekday = strtoupper(substr($startDate->format('D'), 0, 2));
                $ruleComponents[] = "BYDAY={$nthWeek}{$weekday}";
            }
        }

        if ($this->recurrence_end_date) {
            $endDate = Carbon::parse($this->recurrence_end_date)->format('Ymd\THis\Z');
            $ruleComponents[] = 'UNTIL=' . $endDate;
        } else {
            $ruleComponents[] = 'COUNT=50';
        }

        return implode(';', $ruleComponents);
    }


}
