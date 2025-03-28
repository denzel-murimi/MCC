import './bootstrap';
import Alpine from 'alpinejs';
import feather from 'feather-icons';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list'

window.Alpine = Alpine;

Alpine.start();

feather.replace();

window.FullCalendar = {
    Calendar: Calendar,
    dayGridPlugin: dayGridPlugin,
    listPlugin: listPlugin
};

