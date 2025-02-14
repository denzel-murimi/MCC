<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
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
                            'title'=>$event->title,
                            'colour'=>$event->colour,
                            'start_at' => $arguments['event']['start'] ?? $event->start_at,
                            'end_at' => $arguments['event']['end'] ?? $event->end_at,
                            'description' => $event->description
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

    public function eventDidMount(): string
{
    return <<<JS
        function({ event, timeText, isStart, isEnd, isMirror, isPast, isFuture, isToday, el, view }){
            el.setAttribute("x-tooltip", "tooltip");
            el.setAttribute("x-data", "{ tooltip: '"+event.title+"' }");
        }
    JS;
}

    public function fetchEvents(array $info): array
    {
        return Event::query()
            ->where('start_at', '>=', $info['start'])
            ->where('end_at', '<=', $info['end'])
            ->get()
            ->map(
                fn(Event $event) => [
                    'id' => $event->id,
                    'title' => $event->title,
                    'colour' => $event->colour,
                    'start' => $event->start_at,
                    'end' => $event->end_at,
                ]
            )
            ->all();
    }

    public function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->required(),
            ColorPicker::make('colour')
                ->required(),
            Grid::make()
                ->schema([
                    DateTimePicker::make('start_at')
                        ->required(),
                    DateTimePicker::make('end_at')
                        ->required(),
                ]),
            RichEditor::make('description')
                ->required()
                ->columnSpanFull(),
        ];
    }
}
