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

        </div>

    </section>
</x-layout>
