<x-layout>
    <section class="bg-white py-4 md:mb-10">
        <div class="container max-w-screen-2xl mx-auto px-4">

            <x-navbar></x-navbar>

            <x-title>Mathare Care Center</x-title>

            <div class="flex flex-col lg:flex-row justify-between space-x-20">
                <div class="text-center lg:text-left mt-40">
                    <h1 class="font-semibold text-gray-900 text-3xl md:text-6xl leading-normal mb-6">Caring today, <br> shaping tomorrow</h1>

                    <p class="font-light text-gray-400 text-md md:text-lg leading-normal mb-12">We provide care for disabled children and for peoples of <br> worldwide to support people and organizers</p>

                    <button class="px-6 py-4 bg-primary-800 font-semibold text-white text-lg rounded-xl hover:bg-primary-500 transition ease-in-out duration-500">Our Story</button>
                </div>

                <div class="mt-24">
                    <img src="{{asset('images/home-img.png')}}" alt="Image">
                </div>
            </div>
        </div>
    </section>

    <x-subscribe></x-subscribe>

    <x-footer></x-footer>

</x-layout>
