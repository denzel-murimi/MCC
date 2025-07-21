import './bootstrap';
import Alpine from '@alpinejs/csp';
import feather from 'feather-icons';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list'
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import momentPlugin from '@fullcalendar/multimonth';

window.Alpine = Alpine;

Alpine.data('navbarToggle', () => ({
    navbarOpen: false,
    toggleNavbar() {
        this.navbarOpen = !this.navbarOpen;
    },
    get menuClasses() {
        return this.navbarOpen ? 'flex' : 'hidden';
    },
}));

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

