<x-layout>
    <section class="bg-white py-4 md:mb-10">
        <div class="container max-w-screen-2xl mx-auto px-4">
            <x-title>Our Programs</x-title>

            <div x-data="calendar" x-init="init" class="p-6 rounded-lg">
                <!-- Tabs -->
                <div class="flex justify-center items-center mb-6">
                    <div class="bg-gray-100 px-4 py-2 rounded-lg text-sm md:text-lg">
                        <button
                            @click="selectProgramsTab"
                            x-bind:class="ProgramsButtonClass"
                            class="px-4 py-2 rounded-lg focus:outline-none">
                            Programs
                        </button>
                        <button
                            @click="selectCalendarTab"
                            x-bind:class="CalendarButtonClass"
                            class="px-4 py-2 rounded-lg focus:outline-none">
                            Calendar
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="flex items-center justify-center p-4 rounded-b-lg">
                    <!-- Programs -->
                    <div x-show="showPrograms" class="w-full">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                            @if($program->isNotEmpty())
                                @foreach($program as $p)
                                    <div class="h-full">
                                        <div
                                            class="relative flex flex-col h-full max-w-[24rem] overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-md hover:bg-gray-50 cursor-pointer">
                                            <a href="{{ route('program.show', $p->slug) }}"
                                               class="flex flex-col h-full">
                                                <div
                                                    class="relative m-0 overflow-hidden text-gray-700 bg-transparent rounded-none shadow-none bg-clip-border">
                                                    <img
                                                        src="{{$p->featured_image_url}}"
                                                        alt="Featured Image"
                                                        class="w-full h-48 object-cover"/>
                                                </div>
                                                <div class="p-6 flex-grow">
                                                    <div>
                                                        <h4 class="block font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                                            {{$p->title}}
                                                        </h4>
                                                    </div>
                                                    <p class="block mt-3 font-sans text-xl antialiased font-normal leading-relaxed text-gray-700">
                                                        {{\Illuminate\Support\Str::limit($p->description, 100,'...')}}
                                                    </p>
                                                </div>
                                                <div class="flex items-center justify-between p-6 mt-auto">
                                                    <div class="flex items-center justify-start">
                                                        <span
                                                            class="block font-sans text-sm antialiased text-end">{{$p->author}}</span>
                                                    </div>
                                                    <p class="block font-sans text-base antialiased font-normal leading-relaxed text-inherit">
                                                        {{\Carbon\Carbon::parse($p->updated_at)->diffForHumans()}}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if($program->isEmpty())
                            <div class="mt-10 p-8 text-center bg-gray-50 rounded-lg border border-gray-200">
                                <h3 class="mt-4 text-lg font-medium text-gray-900">No programs found</h3>
                                <p class="mt-2 text-gray-500">There are currently no programs in this website.</p>
                            </div>
                        @endif

                        <div class="mt-6">
                            {{ $program->links() }}
                        </div>
                    </div>
                </div>


                <!-- Calendar -->
                <div x-show="showCalendar" class="h-full">
                    <div class="p-4 bg-gray-100">
                        <div class="h-full w-full bg-white shadow-lg rounded-lg p-4">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script @cspNonce>
        document.addEventListener('alpine:init', function() {
            Alpine.data('calendar', () => ({
                tab: 'programs',
                get showPrograms() {
                    return this.tab === 'programs';
                },
                get showCalendar() {
                    return this.tab === 'calendar';
                },
                get ProgramsButtonClass() {
                    return this.tab === 'programs' ? 'bg-primary-800 text-white' : 'text-gray-900';
                },
                get CalendarButtonClass() {
                    return this.tab === 'calendar' ? 'bg-primary-800 text-white' : 'text-gray-900';
                },
                selectProgramsTab() {
                    this.tab = 'programs';
                },
                selectCalendarTab() {
                    this.tab = 'calendar';
                    this.$nextTick(() => this.initCalendar());
                },
                calendarInit: false,
                init(){
                    this.initCalendar();
                    window.addEventListener('resize', this.handleResize);
                },
                handleResize(){
                    if (window.myCalendar) {
                        const newView = window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth';
                        window.myCalendar.changeView(newView);
                        window.myCalendar.setOption('headerToolbar', this.getToolbar);
                    }
                },
                getToolbar(){
                    const isMobile = window.innerWidth < 768;
                    return isMobile
                        ? {
                            left: 'prev,next',
                            center: 'title',
                            right: 'today'
                        } : {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                        };
                },
                async initCalendar(){
                    if (this.calendarInit) {
                        window.myCalendar.updateSize();
                        return;
                    }
                    await this.$nextTick();
                    const calendarEl = document.getElementById('calendar');
                    if(!calendarEl || this.calendarInit) return;
                    const isMobile = window.innerWidth < 768;
                    const initialView = isMobile ? 'listWeek' : 'dayGridMonth';
                    window.myCalendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [
                            FullCalendar.dayGridPlugin,
                            FullCalendar.listPlugin,
                            FullCalendar.timeGridPlugin,
                            FullCalendar.interactionPlugin,
                            FullCalendar.momentPlugin
                        ],
                        initialView: initialView,
                        headerToolbar: this.getToolbar,
                        views: {
                            listWeek: {
                                titleFormat: {year: 'numeric', month: 'short', day: 'numeric'}
                            }
                        },
                        height: 'auto',
                        aspectRatio: isMobile ? 1.2 : 1.8,
                        navLinks: true,
                        selectable: true,
                        nowIndicator: true,
                        weekNumbers: !isMobile,
                        businessHours: {
                            daysOfWeek: [1, 2, 3, 4, 5],
                            startTime: '9:00',
                            endTime: '17:00'
                        },
                        events: async function(fetchInfo, successCallback, failureCallback) {
                            try {
                                const response = await fetch('/api/events');
                                const events = await response.json();

                                function getContrastColor(hex) {
                                    // If hex doesn't start with #, add it
                                    if (!hex.startsWith('#')) hex = '#' + hex;

                                    const r = parseInt(hex.substring(1, 3), 16);
                                    const g = parseInt(hex.substring(3, 5), 16);
                                    const b = parseInt(hex.substring(5, 7), 16);
                                    const brightness = (r * 299 + g * 587 + b * 114) / 1000;
                                    return brightness > 125 ? '#000' : '#fff';
                                }

                                const formattedEvents = events.map(event => ({
                                    id: event.id,
                                    title: event.title,
                                    start: event.start,
                                    end: event.end,
                                    backgroundColor: event.colour,
                                    borderColor: event.colour,
                                    textColor: getContrastColor(event.colour),
                                    allDay: event.allDay,
                                    recurring: event.recurring,
                                    description: event.description || '',
                                    location: event.location || '',
                                    url: event.url || '/program'
                                }));

                                successCallback(formattedEvents);
                            } catch(error) {
                                console.error('Error loading events', error);
                                failureCallback(error);
                            }
                        },
                        eventClick: function (info){
                            if (info.event.url) {
                                window.open(info.event.url);
                                info.jsEvent.preventDefault();
                            } else {
                                const props = info.event.extendedProps;
                                alert(`Event: ${info.event.title}
                                ${props.description ? 'Description: ' + props.description : ''}
                                ${props.location ? 'Location: ' + props.location : ''}`);
                            }
                        },
                        windowResize: this.handleResize,
                        loading: function (isLoading){
                            const el = document.getElementById('loading-indicator');
                            if (el) {
                                el.classList.toggle('hidden', !isLoading);
                            }
                        },
                    });
                    window.myCalendar.render();
                    this.calendarInit = true;
                },
            }));
        });
    </script>
</x-layout>
