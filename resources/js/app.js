import './bootstrap';
import Alpine from 'alpinejs';
import feather from 'feather-icons';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list'
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import momentPlugin from '@fullcalendar/multimonth';

window.Alpine = Alpine;

Alpine.start();

feather.replace();

window.FullCalendar = {
    Calendar: Calendar,
    dayGridPlugin: dayGridPlugin,
    listPlugin: listPlugin,
    timeGridPlugin: timeGridPlugin,
    interactionPlugin: interactionPlugin,
    momentPlugin: momentPlugin,
};

