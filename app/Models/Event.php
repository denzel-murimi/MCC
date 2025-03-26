<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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

    /**
     * @throws InvalidRRule
     * @throws InvalidWeekday
     */
    public function generateRecurringEvents(): \Illuminate\Support\Collection
    {
        if ($this->recurrence_type === 'none') {
            return collect([$this]);
        }

        $rule = $this->buildRecurrenceRule();
        $transformer = new ArrayTransformer();
        $transformerConfig = (new ArrayTransformerConfig())->enableLastDayOfMonthFix();

        $eventDates = $transformer->transform($rule, $transformerConfig);

        return collect($eventDates)->map(function ($occurrence) {
            $startDate = Carbon::instance($occurrence->getStart());
            $endDate = Carbon::instance($occurrence->getEnd());

            return new self([
                'title' => $this->title,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
        });
    }

    /**
     * @throws InvalidRRule
     */
    private function buildRecurrenceRule(): Rule
    {
        $startDate = Carbon::parse($this->start_date);

        $ruleString = 'FREQ=' . strtoupper($this->recurrence_type);

        // Add interval
        if ($this->recurrence_interval) {
            $ruleString .= ';INTERVAL=' . $this->recurrence_interval;
        }

        // Add specific configuration for different recurrence types
        switch ($this->recurrence_type) {
            case 'weekly':
                if (!empty($this->recurrence_days)) {
                    $ruleString .= ';BYDAY=' . implode(',', $this->recurrence_days);
                }
                break;
            case 'monthly':
                if ($this->monthly_recurrence_type === 'nth_day_of_week') {
                    // You might want to add more complex logic here
                    $ruleString .= ';BYDAY=1MO'; // Example: first Monday
                }
                break;
        }

        // Add end date if specified
        if ($this->recurrence_end_date) {
            $endDate = Carbon::parse($this->recurrence_end_date);
            $ruleString .= ';UNTIL=' . $endDate->format('Ymd\THis\Z');
        }

        return new Rule($ruleString, $startDate);
    }
}
