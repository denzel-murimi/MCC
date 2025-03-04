<x-layout>
    <section class="bg-white py-4 md:mb-10">
        <div class="mb-4 md:mb-0 w-full max-w-screen-xl mx-auto relative" style="height:24em;">
            <div class="absolute bottom-0 left-0 w-full h-full z-10"
                 style="background-image: linear-gradient(180deg,transparent,rgba(0,0,0,.7));"></div>
            <img
                src="{{ $program->featured_image_url }}"
                srcset="{{ $program->featured_image_srcset }}"
                sizes="(max-width: 600px) 200px,
           (max-width: 1200px) 800px,
           1200px"
                alt="{{ $program->title ?? 'Program Image' }}"
                class="absolute left-0 top-0 w-full h-full z-0 object-cover rounded-lg"
                loading="lazy"
            />
            <div class="p-4 absolute bottom-0 left-0 z-20">
                <a href="#"
                   class="px-4 py-1 bg-black text-gray-200 inline-flex items-center justify-center mb-2">
                    {{$program->event->title}}
                </a>
                <h2 class="text-4xl font-semibold text-gray-100 leading-tight">
                    {{$program->title}}
                </h2>
                <div class="flex mt-3">
                    <img src="https://ui-avatars.com/api/?name={{urlencode(\Illuminate\Support\Str::of($program->author)->headline())}}&color=FFFFFF&background=000000"
                         class="h-10 w-10 rounded-full mr-2 object-cover" />
                    <div>
                        <p class="font-semibold text-gray-200 text-sm">{{$program->author}} </p>
                        <p class="font-semibold text-gray-400 text-xs"> {{\Carbon\Carbon::parse($program->created_at)->diffForHumans()}} </p>
                    </div>
                </div>
            </div>


        </div>

    </section>
</x-layout>
