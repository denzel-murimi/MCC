<x-layout>
    <section class="bg-white py-4 md:mb-10">
        <div class="container max-w-screen-2xl mx-auto px-4">
            <x-title>Our Programs</x-title>

            <div x-data="{
            tab: 'programs',
            initCalendar() {
                this.$nextTick(() => {
                    var calendarEl = document.getElementById('calendar');
                        if (!calendarEl) return;

                        let initialView = window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth';

                        if (!window.myCalendar) {
                            window.myCalendar = new FullCalendar.Calendar(calendarEl, {
                                plugins: [FullCalendar.dayGridPlugin, FullCalendar.listPlugin],
                                initialView: initialView,
                                headerToolbar: {
                                    left: 'prev,next today',
                                    center: 'title',
                                    right: 'listWeek,dayGridMonth',
                                },
                                events: async function(fetchInfo, successCallback, failureCallback){
                                        try {
                                            let response = await fetch('/api/events');
                                            let events = await response.json();
                                            function getContrastColor(hex) {
                                                let r = parseInt(hex.substring(1, 3), 16);
                                                let g = parseInt(hex.substring(3, 5), 16);
                                                let b = parseInt(hex.substring(5, 7), 16);
                                                let brightness = (r * 299 + g * 587 + b * 114) / 1000;
                                                return brightness > 125 ? '#000' : '#fff';
                                                }
                                            let formattedEvents = events.map(event => ({
                                                    id: event.id,
                                                    title: event.title,
                                                    start: event.start,
                                                    end: event.end,
                                                    backgroundColor: event.colour,
                                                    borderColor: event.colour,
                                                    textColor: getContrastColor(event.colour),
                                                    allDay: event.allDay,
                                                    recurring: event.recurring,
                                                }));
                                            successCallback(formattedEvents);
                                        } catch(error){
                                            console.error('Error loading events', error);
                                            failureCallback(error);
                                        }
                                    },
                            });
                            window.myCalendar.render();
                        } else {
                            setTimeout(() => {
                                window.myCalendar.updateSize();
                            }, 200);
                        }
                });

                 window.addEventListener('resize', function() {
                    if (window.myCalendar) {
                    let newView = window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth';
                    window.myCalendar.changeView(newView);
                    }
                 });
            },
            }" class="p-6 rounded-lg">
                <!-- Tabs -->
                <div class="flex justify-center items-center mb-6">
                    <div class="bg-gray-100 px-4 py-2 rounded-lg text-sm md:text-lg">
                        <button
                            @click="tab = 'programs'"
                            :class="tab === 'programs' ? 'bg-primary-800 text-white' : 'text-gray-900'"
                            class="px-4 py-2 rounded-lg focus:outline-none">
                            Programs
                        </button>
                        <button
                            @click="tab = 'calendar'; initCalendar()"
                            :class="tab === 'calendar' ? 'bg-primary-800 text-white' : 'text-gray-900'"
                            class="px-4 py-2 rounded-lg focus:outline-none">
                            Calendar
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="flex items-center justify-center p-4 rounded-b-lg">
                    <!-- Programs -->
                    <div x-show="tab === 'programs'">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                            @if($program)
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
                            @else
                                <span class="text-xl">No Programs</span>
                            @endif
                        </div>

                        <div class="mt-6">
                            {{ $program->links() }}
                        </div>
                    </div>
                </div>


                <!-- Calendar -->
                <div x-show="tab === 'calendar'" class="h-full">
                    <div class="p-4 bg-gray-100">
                        <div class="h-full w-full bg-white shadow-lg rounded-lg p-4">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
